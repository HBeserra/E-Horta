<?php
session_start();
include_once 'conexao.php';

$_SESSION['Device-ID'] = "11";
$_SESSION['Device-Token'] = "12";


$result_usuario = "INSERT INTO hortas (DeviceID, DeviceToken) VALUES (
						'" .$_SESSION['Device-Token']. "',
                        '" .$_SESSION['Device-Token']. "'
						)";
		$resultado_usario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
			echo "Usuário cadastrado com sucesso";
			header("Location: login.php");
		}else{
			echo "Erro ao cadastrar o usuário";
		}
?>

