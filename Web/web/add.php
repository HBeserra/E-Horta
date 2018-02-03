<?php
session_start();
ob_start();

if(!empty($_SESSION['id'])){
   
    $btnAtiUsuario = filter_input(INPUT_POST, 'btnAtiUsuario', FILTER_SANITIZE_STRING);
    if($btnAtiUsuario){
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);

        
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
                <h2>Adicionar a conta</h2>
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
                <input type="text" name="Code" placeholder="Insira o ID" class="form-control" required autofocus><br>
                <input type="text" name="Code" placeholder="De um apelido para sua horta" class="form-control" required autofocus>
                <input type="text" name="Code" placeholder="Indique a sua localização" class="form-control" required autofocus>
                <br>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Irrigação</label>
                    </div>
                    <select class="custom-select" name="horario">
                        <option selected>Escolha um horario...</option>
                        <option value="1">Manhã</option>
                        <option value="2">Tarde </option>
                        <option value="3">Noite</option>
                        <option value="3">Desativado</option>
                    </select>
                </div>
                
                <input  class="btn btn-lg btn-primary btn-block" type="submit" name="btnAtiUsuario" value="Adicionar"><br>
                <a href="#">Ajuda com o ID do seu e-horta?</a>
            </form>
        </div> <!-- /container -->	
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>