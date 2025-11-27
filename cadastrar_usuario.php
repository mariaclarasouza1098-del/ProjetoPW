<?php
include 'conexao.php';

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];
$nasc = $_POST['Nascimento'] ?? $_POST['nasc'] ?? '';
$susnum = $_POST['susnum'];

$sql="INSERT INTO `cadastro`(`cpf`, `nome`, `email`, `senha`, `nasc`, `susnum`)
 VALUES ('$cpf','$nome','$email','$senha','$nasc','$susnum')";

  $resultado = mysqli_query($conn,$sql);

if($resultado){
    echo "Usuário cadastrado com sucesso!";
}else{
    echo "Erro ao cadastrar usuário: " .mysqli_error($conn);
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Realizado</title>
    
</head>
<body>

    <div class="container">
        <h2>Obrigada por se cadastrar <?php echo htmlspecialchars($nome); ?>, agora faça seu login para ter acesso ao sistema.</h2> 
        <form action="login.php" method="get">
            <button type="submit">LOGIN</button>
        </form>
        <a href="index.html">Voltar</a>
    </div>
</body>
</html>




