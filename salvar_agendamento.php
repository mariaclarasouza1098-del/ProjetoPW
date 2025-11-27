<?php
session_start();

$tipo       = trim($_POST['tipo'] ?? '');
$paciente   = trim($_POST['paciente'] ?? '');
$medico_key = trim($_POST['medico_key'] ?? '');
$observacoes= trim($_POST['observacoes'] ?? '');
$exame      = trim($_POST['exame'] ?? ''); 

if (!$tipo || !$paciente || !$medico_key) {
    $_SESSION['agendamento_erro'] = 'Preencha os campos obrigatórios: tipo, paciente e profissional.';
    header('Location: agendamento.php');
    exit;
}

if ($tipo === 'Exame' && $exame === '') {
    $_SESSION['agendamento_erro'] = 'Por favor, selecione o exame para prosseguir.';
    header('Location: agendamento.php');
    exit;
}

$profissionais = [
    // consultas
    'cons_helio'  => ['nome' => 'Dr. Hélio Migliari', 'local' => 'UBS- COHAB', 'especialidade' => 'Ginecologista'],
    'cons_silva'  => ['nome' => 'Dra. Ana Silva',    'local' => 'UPA',                              'especialidade' => 'Pediatra'],
    'cons_marcos' => ['nome' => 'Dr. Marcos Pereira','local' => 'AME Ourinhos - ao lado da FATEC',     'especialidade' => 'Clínico Geral'],
    'cons_carla'  => ['nome' => 'Dra. Carla Souza',  'local' => 'CS III Vila Odilon',                 'especialidade' => 'Cardiologista'],
'cons_roberta'  => ['nome' => 'Dra. Roberta Lima', 'local' => 'UBS- COHAB', 'especialidade' => 'Ginecologista Obstetra'],
'cons_livia'  => ['nome' => 'Dra. Livia',    'local' => 'UBS- COHAB', 'especialidade' => 'Pediatra'],

    // exames
    'ex_lab'  => ['nome' => 'Dr Carlos Alberto', 'local' => 'UPA'],
    'ex_rx'   => ['nome' => 'Dr. Ricardo', 'local' => 'AME'],
    'ex_us'   => ['nome' => 'Dra. Paula','local' => 'UPA'],
    'ex_end'  => ['nome' => 'Dr. Fernando',  'local' => 'AME'],
];

if (!isset($profissionais[$medico_key])) {
    $_SESSION['agendamento_erro'] = 'Profissional inválido.';
    header('Location: agendamento.php');
    exit;
}

$medico_nome = $profissionais[$medico_key]['nome'];
$local_atendimento = $profissionais[$medico_key]['local'];

// gerar data aleatória de disponibilidade (ex.: entre +2 e +21 dias)
$min_days = 2;
$max_days = 21;
$attempts = 0;
$max_attempts = 40;
$chosen_date = null;

$existing = $_SESSION['agendamentos'] ?? [];

while ($attempts < $max_attempts) {
    $days = rand($min_days, $max_days);
    $candidate = date('Y-m-d', strtotime("+{$days} days"));

    $conflict = false;
    foreach ($existing as $a) {
        if (($a['medico_key'] ?? '') === $medico_key && ($a['data'] ?? '') === $candidate) {
            $conflict = true;
            break;
        }
    }
    if (!$conflict) {
        $chosen_date = $candidate;
        break;
    }
    $attempts++;
}

if (!$chosen_date) {
    $chosen_date = date('Y-m-d', strtotime('+7 days'));
}

$agendamento = [
    'tipo' => $tipo,
    'paciente' => $paciente,
    'data' => $chosen_date,
    'medico_key' => $medico_key,
    'medico' => $medico_nome,
    'local' => $local_atendimento,
    'observacoes' => $observacoes,
    'exame' => $exame,
    'criado_em' => date('Y-m-d H:i:s'),
];

if (!isset($_SESSION['agendamentos']) || !is_array($_SESSION['agendamentos'])) {
    $_SESSION['agendamentos'] = [];
}
$_SESSION['agendamentos'][] = $agendamento;

unset($_SESSION['agendamento_erro']);

header('Location: exameseconsultas.php');
exit;
?>