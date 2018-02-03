<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$erro = false;
	
	$dados_st = array_map('strip_tags', $dados_rc);
	$dados = array_map('trim', $dados_st);
	
	if(in_array('',$dados)){
		$erro = true;
		$_SESSION['msg'] = "Necessário preencher todos os campos";
	}elseif((strlen($dados['senha'])) != (strlen($dados['senha_confirmação']))){
		$erro = true;
		$_SESSION['msg'] = "As senhas devem ser iguais";
    }elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "A senha deve ter no minímo 6 caracteres";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "Caracter ( ' ) utilizado na senha é inválido";
	}else{
		$result_usuario = "SELECT id FROM usuarios WHERE usuario='". $dados['usuario'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este usuário já está sendo utilizado";
		}
		
        
        $result_usuario = "SELECT id FROM verifica WHERE usuario='". $dados['usuario'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este usuário já está sendo utilizado";
		}
        
        $result_usuario = "SELECT id FROM verifica WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este e-mail já está cadastrado";
		}
        
        
		$result_usuario = "SELECT id FROM usuarios WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este e-mail já está cadastrado";
		}
	}
    
    if(!$erro){
		

        $num = (rand(100000,999999));

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
        $data_validade = date('Y-m-d H:i', strtotime('+5 days'));

//==========================================================================

require_once('class.phpmailer.php');

$mail = new PHPMailer(); // instancia a classe PHPMailer

$mail->IsSMTP();

//configuração do gmail
$mail->Port = '465'; //porta usada pelo gmail.
$mail->Host = 'smtp.gmail.com'; 
$mail->IsHTML(true); 
$mail->Mailer = 'smtp'; 
$mail->SMTPSecure = 'ssl';

//configuração do usuário do gmail
$mail->SMTPAuth = true; 
$mail->Username = 'suporte.horta@gmail.com'; // usuario gmail.   
$mail->Password = 'Lion0809'; // senha do email.

$mail->SingleTo = true; 

// configuração do email a ver enviado.
$mail->From = " Suporte"; 
$mail->FromName = "E-Horta |"; 

$mail->addAddress($dados['email']); // email do destinatario.

$mail->Subject = "Codigo da sua conta"; 
$mail->Body = ("<html lang='pt-br'>
<head>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet''>
</head>
<body>
    <div style='width: 100%; height: 80px; background-color: #B8D080;'>
        <center>
            <img style='width: auto; height: 70px; padding: 10px 0 0 0 ;' src='http://horta.tk/web/e-horta%20branco.png'  />
        </center>
    </div>
    <div style='width: 100%; height: 80px; background-color: white;'>
        <center>
            <h1 style='font-family: 'Roboto', sans-serif;'>Bem-vindo/a ao e-horta,  ".$dados['nome']."</h1>
            <br>
        </center>
        <div style='width: 90%; margin:auto '>
               <h3 style='font-family: 'Roboto', sans-serif;'>Codigo de Confirmação</h3>
                <p style='font-family: 'Roboto', sans-serif;'>Use seu código de confirmação a seguir para a conta da e-Horta, ".$dados['email'].",  Valido até ".$data_validade.".</p><br>
            
            <center><h2 style='font-family: 'Roboto', sans-serif; font-size: 30px'>".$num."</h2></center>
            <br><p style='font-family: 'Roboto', sans-serif;'>Para mais informações acesse nosso site <a href='http://www.horta.tk/' style='text-decoration: none; color: black'>www.HORTA.tk</a></p>
            <p style='font-family: 'Roboto', sans-serif;'>Obrigado,<br>Equipe de desenvolvimento  e-horta</p>
        </div>
    </div>
    
    
</body>
</html>");


if(!$mail->Send()){
    $_SESSION['msg'] = "Erro ao enviar Email:".$mail->ErrorInfo;
    header("Location: cadastrar.php");
}
//==========================================================================/

        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
		
		$result_usuario = "INSERT INTO verifica (nome, sobrenome, email, usuario, senha, Code, date, expiration) VALUES (
						'" .$dados['nome']. "',
                        '" .$dados['sobrenome']. "',
						'" .$dados['email']. "',
						'" .$dados['usuario']. "',
						'" .$dados['senha']. "',
                        '".$num."',
                        '".$date."',
                        '".$data_validade."'
						)";
		$resultado_usario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
			$_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
			header("Location: login.php");
		}else{
			$_SESSION['msg'] = "Erro ao cadastrar o usuário";
		}
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