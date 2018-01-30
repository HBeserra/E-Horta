<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	var_dump($dados);
	
    if(($dados['senha']) == ($dados['senha_confirmação'])){
        
        
    }else{
        echo $_SESSION['msg'] = "Erro senhas diferentes";
    }
    
    
}else{
    $_SESSION['msg'] = "Erro ao cadastrar o usuário";
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://horta.tk/img/logo-ehorta.ico">

        <title>Login | E-Horta</title>

        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="748102899791-dnh718ggknqakb5curuc11qq34urmltj.apps.googleusercontent.com">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <form method="POST" action="" class="form-signin">
                <h2>Cadastrar Usuário</h2>
                <p id='msg'></p>
                <?php
                    if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                    if(isset($_SESSION['msgcad'])){
                    echo $_SESSION['msgcad'];
                    unset($_SESSION['msgcad']);
                }
                ?>
                <input type="text" name="nome" placeholder="Nome" class="form-control" required autofocus>
                <input type="text" name="sobrenome" placeholder="Sobrenome" class="form-control" required autofocus>
                <input type="text" name="email" placeholder="e-mail" class="form-control" required autofocus>
                <div class="input-group mb-3" style="height: 46px">
                    <div class="input-group-prepend">
                        <span style="height: 46px; padding: 9px 10px" class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" class="form-control" name="usuario" placeholder="Username" class="form-control">
                </div>
                <input type="password" name="senha" placeholder="Senha" class="form-control" required autofocus>
                <input type="password" name="senha_confirmação" placeholder="Comfirme a senha" class="form-control" required autofocus>
                <input  class="btn btn-lg btn-primary btn-block" type="submit" name="btnCadUsuario" value="Cadastrar">
                <a href="login.php">Clique aqui</a> para logar
            </form>
        </div> <!-- /container -->	
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>