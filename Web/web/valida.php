<?php
session_start();
include_once("conexao.php");
$log = false;
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if($log == false) {
        //Pesquisar o usuário no BD
        $result_usuario = "SELECT id, nome, sobrenome, email, senha FROM usuarios WHERE 
        usuario='$usuario' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if($resultado_usuario){
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            //var_dump($row_usuario);
            if(password_verify($senha, $row_usuario['senha'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['sobrenome'] = $row_usuario['sobrenome'];
                $_SESSION['email'] = $row_usuario['email'];
                $_SESSION['usuario'] = $usuario;
                header("Location: administrativo.php");	
                $log = true;
            }
        }
    }
    if($log == false) {
        $result_usuario = "SELECT id, nome, sobrenome, email, senha, Code FROM verifica WHERE usuario='$usuario' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if($resultado_usuario){
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            if(password_verify($senha, $row_usuario['senha'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['sobrenome'] = $row_usuario['sobrenome'];
                $_SESSION['email'] = $row_usuario['email'];
                $_SESSION['Code'] = $row_usuario['Code'];
                $_SESSION['usuario'] = $usuario;
                header("Location: Ativa.php");	
                $log = true;
            }
        }
    }else{
	$_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada</div>";
	header("Location: login.php");
}
    if($log == false){
        $_SESSION['msgcad'] = "<div class='alert alert-danger'>Usuario ou senha invalido</div>";
        header("Location: login.php");
    }
    
}else{
	$_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada</div>";
	header("Location: login.php");
}


