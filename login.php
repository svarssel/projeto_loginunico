<?php
session_start();
require 'config.php';


$_SESSION['lg'] = '';


if (isset($_POST['senha']) && !empty($_POST['email'])) {
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = MD5(:senha)";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":email", $email);
	$sql->bindValue(":senha", $senha);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql = $sql->fetch();
		$id = $sql['id'];
		$ip = $_SERVER['REMOTE_ADDR'];

		$_SESSION['lg'] = $id;

		header("Location: index.php");
		exit;
	}
}

?>

<h1>Login</h1>

<form method="POST">

	E-mail:<br />
	<input type="email" name="email" /><br /><br />

	Senha:<br />
	<input type="password" name="senha" /><br /><br />

	<input type="submit" value="Entrar" />
</form>