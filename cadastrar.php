<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

$sql = "select count(*) as total from usuario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);
$mat = mysqli_fetch_assoc($result);

$consultaRegistro = "SELECT * FROM usuario WHERE usuario = '{$usuario}'";

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: register-form.php');
	exit;
}


if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: register-form.php');
	exit;
}

$sql = "INSERT INTO `usuario`(`usuario`, `senha`, `nome`) VALUES ('$usuario','$senha','$nome')";

if($conexao -> query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: register-form.php');
exit;

?>