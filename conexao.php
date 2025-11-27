<?php
//dados de conexão 
$host="Localhost";
$usuario= "root";
$senha="";
$banco="sus";

//tentar conectar o banco 
$conn = mysqli_connect($host,$usuario,$senha,$banco);


if($conn){
  // Conexão bem-sucedida
}else{
    die("erro de conexão:".mysqli_connect_error());
}
  ?>  
