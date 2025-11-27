<?php
session_start();
include 'conexao.php';

$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? ''; 
$sql = "SELECT nome FROM `cadastro` WHERE `cpf`='$cpf' and `senha`='$senha'";
$resultado = mysqli_query($conn, $sql);


if ($resultado === false) {
    die("Erro ao executar a consulta: " . mysqli_error($conn));
}


if(mysqli_num_rows($resultado) > 0){
    
    // 1. BUSCA OS DADOS DA LINHA (que contém o nome)
    $dados_usuario = mysqli_fetch_assoc($resultado);

    // 2. ARMAZENA O NOME DO USUÁRIO NA VARIÁVEL DE SESSÃO 'nome'
    //    Isso permite que você o acesse no menu.php
    $_SESSION['nome'] = $dados_usuario['nome']; 
    
    // 3. Define o status de login
    $_SESSION['cadastro'] = true; 
    
    header('Location: menu.php');
    exit(); // Sempre usar exit() após header('Location')
} else {
    $_SESSION['erro_login'] = "CPF ou senha incorretos.";
    header('Location: login.php');
    exit();
}

?>