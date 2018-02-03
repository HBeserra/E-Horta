<?php
session_start();
ob_start();

if(!empty($_SESSION['Code'])){
   
    $btnAtiUsuario = filter_input(INPUT_POST, 'btnAtiUsuario', FILTER_SANITIZE_STRING);
    if($btnAtiUsuario){
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);

        if(($dados['Code']) == ($_SESSION['Code'])){
            echo "ok";
            include_once 'conexao.php';

            $usuario = $_SESSION['usuario'];

            $result_usuario = "SELECT senha FROM verifica WHERE 
            usuario='$usuario' LIMIT 1";
            $resultado_usuario = mysqli_query($conn, $result_usuario);

            if($resultado_usuario){
                $row_usuario = mysqli_fetch_assoc($resultado_usuario);


                $result_usuario = "INSERT INTO usuarios (nome, sobrenome, email, usuario, senha) VALUES (
                            '" .$_SESSION['nome']. "',
                            '" .$_SESSION['sobrenome']. "',
                            '" .$_SESSION['email']. "',
                            '" .$_SESSION['usuario']. "',
                            '" .$row_usuario['senha']. "'
                            )";
                $resultado_usario = mysqli_query($conn, $result_usuario);
                if(mysqli_insert_id($conn)){





                    $_SESSION['msgcad'] = "Conta ativada com sucesso";
                    header("Location: login.php");
                }else{
                    $_SESSION['msg'] = "Erro ao ativar a conta";
                }    
            }else{
                $_SESSION['msg'] = "Erro!";
            }
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Codigo incoreto</div>";
        }
    }
    
}else{
   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
   header("Location: administrativo.php");	
}
            
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://horta.tk/img/logo-ehorta.ico">

        <title>Ativação | E-Horta</title>

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
                <h2>Confirmar a conta</h2>
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
                <input type="text" name="Code" placeholder="Insira seu Codigo" class="form-control" required autofocus><br>
                
                <input  class="btn btn-lg btn-primary btn-block" type="submit" name="btnAtiUsuario" value="Cadastrar"><br>
                não recebeu? <a href="#">Clique aqui</a> para enviar outro codigo
            </form>
        </div> <!-- /container -->	
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>