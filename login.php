<?php
session_start();
include('conexao.php');

if(empty($_POST['id']) || empty($_POST['data'])){
    header('Location: login-form.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['id']);
$senha = mysqli_real_escape_string($conexao, $_POST['data']);

$query = "select * from alunos where id = '{$usuario}' and data = '{$senha}'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $senha;
    header('Location: painel.php');
    exit();
}else{
    $_SESSION['nao autenticado'] = true;
    header('Location: login-form.php');
    exit();
}

?>