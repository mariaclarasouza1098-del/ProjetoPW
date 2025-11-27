<?php
include 'conexao.php';
session_start();

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário'; 

// Verifica se o usuário está autenticado
if(!isset($_SESSION['cadastro']) || $_SESSION['cadastro'] !== true){
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu SUS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #84aff0;
            margin: 0;
            padding: 20px;
        }

        .logout-button {
            background-color: #f51a0aff; 
            color: white;
            padding: 10px 20px; 
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }

        .welcome-message {
            padding: 20px;
            text-align: center;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: #091f45ff;
            margin: 0 0 10px 0;
            font-size: 1.8em;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px 0;
            max-width: 900px;
            margin: 0 auto;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            width: 100%;
            max-width: 250px;
            display: block;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .img-wrapper {
            height: 190px;
            width: 75%;
            overflow: hidden;
            padding-top: 25px;
        }

        .card-img {
            width: 100px;
            height: auto;
            padding-top: 25px;
        }

        .card-content {
            padding: 15px;
            text-align: center;
        }

        .card-content h2 {
            color: #000000ff;
            margin-top: 0;
            font-size: 1.3em;
            font-family: Arial, Helvetica, sans-serif;
        }

        .card-content p {
            color: #555;
            font-size: 0.9em;
        }

        p {
            text-align: center;
            font-size: 1.2em; 
        }
    </style>
</head>
<body>
    
    <div class="welcome-message">
        <h1>Olá, <?php echo htmlspecialchars($nome); ?>!</h1>
        <p>Seja bem-vindo ao sistema Online SUS, do que você precisa hoje?</p>
    </div>
    
    <div class="card-container">
        
        <a href="agendamento.php" class="card-link">
            <div class="card">
                <div class="img-wrapper">
                    <img src="img/agenda.png" class="card-img">
                </div>
                <div class="card-content">
                    <h2>Agendamento de Consultas</h2>
                    <p>Marque sua consulta ou exame agora de forma rápida e prática.</p>
                </div>
            </div>
        </a>
        
        <a href="vacinas.html" class="card-link">
            <div class="card">
                <div class="img-wrapper">
                    <img src="img/seringa.png" class="card-img">
                </div>
                <div class="card-content">
                    <h2>Vacinação</h2>
                    <p>Confira as datas de vacinação disponíveis.</p>
                </div>
            </div>
        </a>
        
        <a href="exameseconsultas.php" class="card-link">
            <div class="card">
                <div class="img-wrapper">
                    <img src="img/historico-medico.png" class="card-img">
                </div>
                <div class="card-content">
                    <h2>Seus Exames e Consultas</h2>
                    <p>Veja aqui seus exames e consultas agendadas.</p>
                </div>
            </div>
        </a>

        <a href="outubro.html" class="card-link">
            <div class="card">
                <div class="img-wrapper">
                    <img src="img/Laco-rosa-azul.png" class="card-img">
                </div>
                <div class="card-content">
                    <h2>Campanhas: Outubro Rosa e Novembro Azul</h2>
                    <p>Veja a história dessas campanhas e a importância da prevenção.</p>
                </div>
            </div>
        </a>
      
    </div>

    <div class="logout-button-container">
        <a href="logout.php" class="logout-button">Sair</a>
    </div>

</body>
</html>