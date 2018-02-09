<?php
session_start();
/*$_SESSION['msg'] = "<div class='alert alert-primary' role='alert'>This is a primary alert—check it out!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

if(!empty($_SESSION['id'])){
   include_once("dashboard.php");
}else{
   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
   header("Location: login.php");	
}
*/
$btnGenCode = filter_input(INPUT_POST, 'btnGenCode', FILTER_SANITIZE_STRING);
if($btnGenCode){
    unset($_SESSION['Device-ID']); 
    unset($_SESSION['Device-Token']);    
        
    $_SESSION['Device-ID'] = uniqid("");
    $_SESSION['Device-Token'] = md5(uniqid(rand(), true));
    
    //echo $_SESSION['Device-ID'],  '<br/>';
    //echo $_SESSION['Device-Token'],  '<br/>';  
    
    if((isset($_SESSION['Device-ID'])) & (isset($_SESSION['Device-Token']))){
        
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao gerar o ID e ou Token<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
}

$btnConfirma = filter_input(INPUT_POST, 'btnConfirma', FILTER_SANITIZE_STRING);
if($btnConfirma){
    include_once 'conexao.php';
    $result_usuario = "INSERT INTO hortas (DeviceID, DeviceToken) VALUES (
						'" .$_SESSION['Device-ID']. "',
                        '" .$_SESSION['Device-Token']. "'
						)";
		$resultado_usario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
			$_SESSION['msgcad'] = "<div class='alert alert-success' role='alert'>Dispositivo cadastrado com sucesso!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			//header("Location: Adm_Hortas.php");
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o dispositivo!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		}
    
    
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
            <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        echo "<br>";
                        unset($_SESSION['msg']);
                }
                    if(isset($_SESSION['msgcad'])){
                        echo $_SESSION['msgcad'];
                        echo "<br>";
                        unset($_SESSION['msgcad']);
                }
                ?>
            <center><h2>Cadastrar Dispositivo</h2></center>
            <form method="POST" action="" class="form-signin">
                <input class="btn btn-lg btn-primary btn-block" type="submit" name="btnGenCode" value="Gerar ID e Token">
            </form>
            <form method="POST" action="" class="form-signin"> 
                <h4>Configuração</h4>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-secondary">ID</li>
                    <li class="list-group-item"><?php if(isset($_SESSION['Device-ID'])){ echo $_SESSION['Device-ID']; }else{echo" ";} ?></li>
                    <li class="list-group-item list-group-item-secondary">Token</li>
                    <li class="list-group-item"><?php if(isset($_SESSION['Device-Token'])){echo $_SESSION['Device-Token'];}else{echo" ";} ?></li>
                </ul>
                <br />
                <input class="btn btn-lg btn-success btn-block" type="submit" name="btnConfirma" value="Confirmar">
            </form>
        </div> <!-- /container -->	
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>


