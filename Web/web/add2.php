<?php
session_start();
if(!empty($_SESSION['id'])){

    if(isset($_GET["payload"])){
        echo ("a is set\n".$_GET["payload"])."</BR>";   
        echo "ID - ".$_SESSION['ID']."<br>";
        echo "Apelido - ".$_SESSION['Apelido']."<br>";
        echo "Local - ".$_SESSION['Local']."<br>";
        echo "horario - ".$_SESSION['horario']."<br>";
        
        $btnAtiUsuario = filter_input(INPUT_POST, 'btnAtiUsuario', FILTER_SANITIZE_STRING);
        if($btnAtiUsuario){
            $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            
        
    }
    
    }
    
    
}else{
   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
   header("Location: login.php");	
}


/* 
echo $_SESSION['horario']."<br>";
if(isset($_GET["payload"])){echo "a is set\n";   }
    $btnAtiUsuario = filter_input(INPUT_POST, 'btnAtiUsuario', FILTER_SANITIZE_STRING);
    if($btnAtiUsuario){
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
        
       
        $result_usuario = "SELECT DeviceID, DeviceToken, active FROM hortas WHERE 
        DeviceID='".$dados_rc['ID']."' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if($resultado_usuario){
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            var_dump($row_usuario);
            if($row_usuario["DeviceID"] == $dados_rc['ID']){
                $_SESSION['ID'] = $row_usuario['DeviceID'];
                $_SESSION['nome'] = $row_usuario['DeviceToken'];
                $_SESSION['sobrenome'] = $row_usuario['active'];

                $_SESSION['Apelido'] = $dados_rc["Apelido"];
                $_SESSION['Local'] = $dados_rc["Local"];
                $_SESSION['horario'] = $dados_rc["horario"];

                $_SESSION['msg'] = "<div class='alert alert-info'>ID Valido!</div>";
                header("Location: add1.php");
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>ID Inválido!</div>";
                header("Location: Add.php");
            }
            
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao acessar o banco de dados!</div>";
            header("Location: Add.php");
        }
        
        
        
        
        
        
        //var_dump($dados_rc);
        $_SESSION['ID'] = $dados_rc["ID"];
        $_SESSION['Apelido'] = $dados_rc["Apelido"];
        $_SESSION['Local'] = $dados_rc["Local"];
        $_SESSION['horario'] = $dados_rc["horario"];

        echo $_SESSION['ID']."<br>";
        echo $_SESSION['Apelido']."<br>";
        echo $_SESSION['Local']."<br>";
        echo $_SESSION['horario']."<br>";
        
        //$_SESSION['msg'] = "<div class='alert alert-info'>ID Valido!</div>";
        //header("Location: administrativo.php");	
        
        
        
        
        
    
    
//}else{
//   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
//   //header("Location: administrativo.php");	
//}
*/            
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
            
            
            
            <h4>Configuração</h4>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-secondary">Apelido</li>
                    <li class="list-group-item"><?php if(isset($_SESSION['Apelido'])){ echo $_SESSION['Apelido']; }else{echo" ";} ?></li>
                    <li class="list-group-item list-group-item-secondary">Local</li>
                    <li class="list-group-item"><?php if(isset($_SESSION['Local'])){echo $_SESSION['Local'];}else{echo" ";} ?></li>
                    <li class="list-group-item list-group-item-secondary">Token</li>
                    <li class="list-group-item"><?php if(isset($_SESSION['Local'])){echo $_SESSION['Local'];}else{echo" ";} ?></li>
                </ul>
            
                <br />
            
            
        </div> <!-- /container -->	
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>