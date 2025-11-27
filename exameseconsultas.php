<?php
session_start();
$agendamentos = $_SESSION['agendamentos'] ?? [];

// Processa cancelamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelar_index'])) {
    $index = (int)$_POST['cancelar_index'];
    if (isset($_SESSION['agendamentos'][$index])) {
        unset($_SESSION['agendamentos'][$index]);
        $_SESSION['agendamentos'] = array_values($_SESSION['agendamentos']); // reindexar
    }
    header('Location: exameseconsultas.php');
    exit;
}

$agendamentos = $_SESSION['agendamentos'] ?? [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Exames e Consultas - SUS</title>
    <style>
        :root{ 
            --card:#fff;
            --primary-dark:#3474e6; 
            --muted:#6b7b8c; 
            --text:#03203a;
            --danger:#d9534f;
        }
        body{ 
            margin:0; 
            font-family:Arial,Helvetica,sans-serif; 
            background-color: #84aff0;
            color:var(--text); 
            padding:24px; 
            display:flex; 
            justify-content:center;
            min-height: 100vh;
        }
        .wrap{ 
            width:100%; 
            max-width:900px; 
        }
        img.logo{ 
            max-width:350; 
            height:150px;
            display:block; 
            margin:0 auto 12px; 
        }
        h1{ 
            text-align:center; 
            color: #000000ff; 
            margin:6px 0 24px;
            font-size: 28px;
        }
        .list{ 
            display:grid; 
            gap:20px;
        }
        .item{ 
            background:var(--card); 
            padding:24px; 
            border-radius:10px; 
            box-shadow:0 6px 18px rgba(0,0,0,0.06);
        }
        .meta{ 
            font-size:16px; 
            color:var(--text); 
            margin-bottom:12px;
            line-height: 1.4;
        }
        .title{ 
            font-size:20px; 
            font-weight:600; 
            margin:0 0 15px 0;
            color:var(--primary-dark);
        }
        .exames-list {
            margin: 10px 0;
            padding-left: 20px;
        }
        .exames-list li {
            margin-bottom: 8px;
            font-size: 16px;
        }
        .empty{ 
            text-align:center; 
            color:var(--muted); 
            padding:24px; 
            background:var(--card); 
            border-radius:10px;
            font-size: 16px;
        }
        .actions{ 
            margin-top:20px; 
            display:flex; 
            gap:12px;
            flex-wrap: wrap;
        }
        a.button, button.button{ 
            text-decoration:none; 
            padding:12px 20px; 
            border-radius:8px; 
            background:var(--primary-dark); 
            color:#fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        a.button:hover, button.button:hover{ 
            background: #2563d1;
        }
        button.button-danger {
            background:  #f51717ff;
        }
        button.button-danger:hover {
            background: #c4241eff;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            color: var(--primary-dark);
            font-weight: 500;
            margin-right: 8px;
        }
        .voltar-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4da3ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
        .voltar-link:hover {
            background-color: #3474e6;
        }
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.26);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal-backdrop.active {
            display: flex;
        }
        .modal {
            background: var(--card);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .modal h2 {
            margin-top: 0;
            color: var(--text);
            font-size: 20px;
        }
        .modal p {
            color: black;
            margin: 15px 0;
        }
        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
        }
        .modal-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        .modal-actions .btn-confirm {
            background: #ca0000ff;
            color: #000000ff;
        }
       
    </style>
</head>
<body>
    <div class="wrap">
        <img src="img/susdigital.png" alt="SUS" class="logo">
        <h1>Seus Exames e Consultas</h1>

        <?php if (empty($agendamentos)) : ?>
            <div class="empty">
                Nenhum agendamento encontrado. 
                <br><br>
                <a href="agendamento.php" class="button">Agendar agora</a>
            </div>
        <?php else: ?>
            <div class="list">
                <?php foreach (array_reverse($agendamentos) as $index => $a): 
                    $realIndex = count($agendamentos) - 1 - $index;
                ?>
                    <div class="item">
                        <div class="title">
                            <span class="badge"><?php echo htmlspecialchars($a['tipo']); ?></span>
                            <?php echo htmlspecialchars($a['paciente']); ?>
                        </div>
                        
                        <div class="meta">
                            <strong>Profissional:</strong> <?php echo htmlspecialchars($a['medico']); ?>
                        </div>
                        
                        <div class="meta">
                            <strong>Local:</strong> <?php echo htmlspecialchars($a['local']); ?>
                        </div>
                        
                        <div class="meta">
                            <strong>Data:</strong> <?php echo date('d/m/Y', strtotime($a['data'])); ?>
                        </div>
                        
                        <?php if (!empty($a['exame'])): ?>
                        <div class="meta">
                            <strong>Exame agendado:</strong>
                            <div class="badge" style="margin-top:8px; font-size:16px;">
                                <?php echo htmlspecialchars($a['exame']); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($a['observacoes'])): ?>
                        <div class="meta">
                            <strong>Observações:</strong><br>
                            <?php echo nl2br(htmlspecialchars($a['observacoes'])); ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="meta" style="margin-top:12px; font-size:14px; color:#888;">
                            Agendado em: <?php echo date('d/m/Y H:i', strtotime($a['criado_em'])); ?>
                        </div>

                        <div class="actions">
                            <button type="button" class="button button-danger" onclick="openModal(<?php echo $realIndex; ?>)">
                                Cancelar <?php echo htmlspecialchars($a['tipo']); ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div style="text-align: center;">
        <a href="menu.php" class="voltar-link">Voltar ao menu</a>
    </div>

    <div id="confirmModal" class="modal-backdrop">
        <div class="modal">
            <h2>Confirmar Cancelamento</h2>
            <p>Tem certeza que deseja cancelar este agendamento?</p>
            <p style="font-size:14px; color:#666;">Esta ação não pode ser desfeita.</p>
            
            <form id="cancelForm" method="POST" style="display:none;">
                <input type="hidden" name="cancelar_index" id="cancelIndex" value="">
            </form>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Manter Agendamento</button>
                <button type="button" class="btn-confirm" onclick="confirmCancel()">Cancelar Agendamento</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(index) {
            document.getElementById('cancelIndex').value = index;
            document.getElementById('confirmModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.remove('active');
        }

        function confirmCancel() {
            document.getElementById('cancelForm').submit();
        }

        // Fecha modal se clicar fora dele
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>