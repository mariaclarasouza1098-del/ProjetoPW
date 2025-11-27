<?php
session_start();
$nomeUsuario = $_SESSION['nome'] ?? '';
$erro = $_SESSION['agendamento_erro'] ?? '';
unset($_SESSION['agendamento_erro']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agendamento - SUS</title>
    <style>
        :root{
            --bg:#84aff0;
            --primary:#4da3ff;
            --primary-dark:#3474e6;
            --card:#ffffff;
            --text:#03203a;
            --muted:#6b7b8c;
            --danger:#d9534f;
        }
        body{
            background-color: #84aff0;
            margin:0;
            font-family:Arial,Helvetica,sans-serif;
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:24px;
            min-height:100vh;
        }
        .logo{
             max-width:560px; 
             height:150px;
             display:block;
             }
        .card{
            width:100%;
             max-width:720px;
              background:var(--card); 
              border-radius:10px;
            padding:24px; 
            box-shadow:0 8px 28px rgba(10,30,60,0.08);
        }
        h1{ margin:0 0 10px;
             color:var(--primary-dark);
              text-align:center; 
              font-size:28px; 
            }
        form{ display:grid;
             gap:12px;
              margin-top:12px;
             }
        label{ font-size:16px;
             color:var(--text);
             }
        input[type="text"], select, textarea {
            width:100%;
            padding:12px 14px;
            border:1px solid rgba(7,40,80,0.08);
            border-radius:6px;
            background:#fbfeff;
            font-size:16px;
        }
        .row{ display:flex; gap:12px; }
        .row .col{ flex:1; }
        button{
            padding:14px;
            background:var(--primary);
            color:#fff;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:18px;
        }
        button:hover{ background:var(--primary-dark); }
        .links{ margin-top:12px; display:flex; justify-content:space-between; align-items:center; }
        .link{ color:var(--primary-dark); text-decoration:none; font-size:16px; }
        .exames-section {
            display: none;
            margin-top: 15px;
            padding: 20px;
            background: #f8faff;
            border-radius: 8px;
            border: 1px solid rgba(52,116,230,0.1);
        }
        .exames-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }
        .exame-option {
            font-size:16px;
            padding:10px;
            background:white;
            border-radius:6px;
            display:flex;
            align-items:center;
            gap:8px;
            cursor:pointer;
            transition:background 0.15s;
        }
        .exame-option:hover { background:#f0f8ff; }
        .hint{ font-size:14px; color:var(--muted); margin-top:6px; }
        .error { color:var(--danger); margin-bottom:8px; font-weight:600; }
        @media(max-width:520px){
            .row{ flex-direction:column; }
            h1 { font-size:24px; }
        }
    </style>
</head>
<body>
    <img src="img/susdigital.png" alt="SUS" class="logo">
    <div class="card">
        <h1>Agendamento de Consultas e Exames</h1>

        <?php if (!empty($erro)): ?>
            <div class="error"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>

        <form action="salvar_agendamento.php" method="post" autocomplete="off">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="Consulta">Consulta</option>
                <option value="Exame">Exame</option>
            </select>

            <div class="row">
                <div class="col">
                    <label for="paciente">Nome do paciente</label>
                    <input type="text" name="paciente" id="paciente" value="<?php echo htmlspecialchars($nomeUsuario); ?>" required>
                </div>
                <div class="col">
                    <label for="medico_key">Profissional</label>
                    <select name="medico_key" id="medico_key" required>
                    </select>
                   
                </div>
            </div>

            <div id="examesSection" class="exames-section" aria-hidden="true">
                <h2 style="font-size:20px; margin:0 0 12px; color:var(--primary-dark);">Selecione o exame</h2>
                <div class="exames-grid">
                    <label class="exame-option"><input type="radio" name="exame" value="Hemograma"> <span>Hemograma</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Glicemia"> <span>Glicemia</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Colesterol"> <span>Colesterol</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Triglicerídeos"> <span>Triglicerídeos</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Urina"> <span>Urina Tipo 1</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Fezes"> <span>Parasitológico</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Raio X"> <span>Raio X</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Ultrassom"> <span>Ultrassom</span></label>
                      <label class="exame-option"><input type="radio" name="exame" value="Mamografia"> <span>Mamografia</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="Endoscopia"> <span>Endoscopia</span></label>
                    <label class="exame-option"><input type="radio" name="exame" value="próstata "> <span>Próstata </span></label>

                </div>
            </div>

            <label for="observacoes">Observações:</label>
          <span>Alguns exames requerem jejum ou preparo específico. Se informe e se prepare adequadamente.</span>
            <p style="font-size:16px; color:var(--muted); margin:6px 0 0 0;">
                A data será atribuída conforme disponibilidade do profissional, Na pagina de exames e consultas marcadas você pode ver a data do seu agendamento.
            </p>

            <button type="submit">Agendar</button>

            <div class="links">
                <a class="link" href="menu.php">Voltar ao menu</a>
                <a class="link" href="exameseconsultas.php">Ver agendamentos</a>
            </div>
        </form>
    </div>

    <script>
        (function(){
            const tipoEl = document.getElementById('tipo');
            const medicoSelect = document.getElementById('medico_key');
            const examesSection = document.getElementById('examesSection');

            // Profissionais separados por tipo
            const consultaProfessionals = {
                'cons_helio': { nome: 'Dr. Hélio Migliari', local: 'UBS - COHAB', especialidade: 'Ginecologista' },
                'cons_silva': { nome: 'Dra. Ana Silva',      local: 'UPA',                                 especialidade: 'Pediatra' },
                'cons_marcos':{ nome: 'Dr. Marcos Pereira',  local: 'AME Ourinhos - ao lado da FATEC',     especialidade: 'Clínico Geral' },
                'cons_carla': { nome: 'Dra. Carla Souza',    local: 'CS III Vila Odilon',                  especialidade: 'Cardiologista' },
                'cons_roberta': { nome: 'Dra. Roberta Lima',    local: 'UBS- COHAB', especialidade: 'Ginecologista Obstetra' },
                'cons_livia': { nome: 'Dra. Livia',    local: 'UBS- COHAB', especialidade: 'Pediatra' }

            };

            const exameProfessionals = {
                'ex_lab':  { nome: 'Dr. Carlos Alberto', local: 'UPA', especialidade: ''},
                'ex_rx':   { nome: 'Dr. Ricardo', local: 'AME', especialidade: ''},
                'ex_us':   { nome: 'Dra. Paula', local: 'UPA', especialidade: ''},
                'ex_end':  { nome: 'Dr. Fernando', local: 'AME', especialidade: '' }
            };

            function populateMedicos(list) {
                medicoSelect.innerHTML = '<option value="" disabled selected>Selecione o profissional disponível...</option>';
                Object.keys(list).forEach(key => {
                    const p = list[key];
                    const opt = document.createElement('option');
                    opt.value = key;
                    opt.textContent = p.nome + '  ' + p.especialidade;
                    medicoSelect.appendChild(opt);
                });
              
            }

            function toggleExamesAndMedicos() {
                const tipo = tipoEl.value;
                if (tipo === 'Exame') {
                    examesSection.style.display = 'block';
                    populateMedicos(exameProfessionals);
                } else {
                    examesSection.style.display = 'none';
                    examesSection.querySelectorAll('input[name="exame"]').forEach(r => { r.checked = false; r.required = false; });
                    populateMedicos(consultaProfessionals);
                }
            }

            // atualiza especialidade exibida quando muda o profissional
            medicoSelect.addEventListener('change', function(){
                const opt = medicoSelect.selectedOptions[0];
                if (opt) {
                    const esp = opt.dataset.especialidade || '';
                    const local = opt.dataset.local || '';
                    let txt = '';
                    if (esp) txt += 'Especialidade: ' + esp;
                    if (local) txt += (txt ? ' • ' : '') + 'Local: ' + local;
                    especialidadeEl.textContent = txt;
                } else {
                    especialidadeEl.textContent = '';
                }
            });

            tipoEl.addEventListener('change', toggleExamesAndMedicos);
        })();
    </script>

</body>
</html>