<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	//echo "$usuario - $senha";
	if((!empty($usuario)) AND (!empty($senha))){
		//Pesquisar o usuário no BD
		$result_usuario = "SELECT id, nome, email, senha, foto_perfil, acesso, dashboard, Horta_id_1, Horta_id_2, Horta_id_3  FROM usuarios WHERE usuario='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if(password_verify($senha, $row_usuario['senha'])){
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['email'] = $row_usuario['email'];
				$_SESSION['foto_perfil'] = $row_usuario['foto_perfil'];
				$_SESSION['acesso'] = $row_usuario['acesso'];
				$_SESSION['dashboard'] = $row_usuario['dashboard'];
				$dashboard = $_SESSION['dashboard'];
				$_SESSION['Horta_id_1'] = $row_usuario['Horta_id_1'];
				$_SESSION['Horta_id_2'] = $row_usuario['Horta_id_2'];
				$_SESSION['Horta_id_3'] = $row_usuario['Horta_id_3'];
				header("Location: administrativo.php");	
			}else{
				$_SESSION['msg'] = "Login e senha incorreto!";
				header("Location: login.php");
			}
		}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
		header("Location: login.php");
	}
}else{
	$_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada</div>";
	header("Location: login.php");
}
