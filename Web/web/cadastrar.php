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
		$_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos!</div>";
	}elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "<div class='alert alert-danger'>A senha deve ter no minímo 6 caracteres!</div>";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "<div class='alert alert-danger'>Caracter ( ' ) utilizado na senha é inválido!</div>";
	}else{
		$result_usuario = "SELECT id FROM usuarios WHERE usuario='". $dados['usuario'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger'>Este usuário já está sendo utilizado!</div>";
		}
		
		$result_usuario = "SELECT id FROM usuarios WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "<div class='alert alert-danger'>Este e-mail já está cadastrado!</div>";
		}
	}
	
	
	//var_dump($dados);
	if(!$erro){
		//var_dump($dados);
		$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
		
		$result_usuario = "INSERT INTO usuarios (nome, email, usuario, senha) VALUES (
						'" .$dados['nome']. "',
						'" .$dados['email']. "',
						'" .$dados['usuario']. "',
						'" .$dados['senha']. "'
						)";
		$resultado_usario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
			$_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
			header("Location: login.php");
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o usuário!</div>";
		}
	}
	
}
?>
<!doctype html>
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
			<div class="form-signin" style="background: #42dea4;">
				<h2>Cadastrar Usuário</h2>
				<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
				?>
				<form method="POST" action="">
					<!--<label>Nome</label>-->
					<input type="text" name="nome" placeholder="Digite o nome e o sobrenome" class="form-control"><br>
					
					<!--<label>E-mail</label>-->
					<input type="text" name="email" placeholder="Digite o seu e-mail" class="form-control"><br>
					
					<!--<label>Usuário</label>-->
					<input type="text" name="usuario" placeholder="Digite o usuário" class="form-control"><br>
					
					<!--<label>Senha</label>-->
					<input type="password" name="senha" placeholder="Digite a senha" class="form-control"><br>
					
					<input type="submit" name="btnCadUsuario" value="Cadastrar" class="btn btn-success"><br><br>
					
					<div class="row text-center" style="margin-top: 20px;"> 
						Lembrou? <a href="login.php">Clique aqui</a> para logar
					</div>
				</form>
			</div>
		</div>
       <div class="container">

         <form method="POST" action="valida.php" class="form-signin">
            <h2 class="form-signin-heading">Entre na sua conta</h2>
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
            
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            <div style="display: flex; margin: 0 0 10px 0" >
               <span style=" margin: 0 auto 0 0" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="margin-top: 20px;"></span>
               <a style=" margin: 0 0 0 auto" href="<?php echo $loginUrl; ?>">
                  <button type="button" class="btn btn-primary">
                     <img class="_5h0l img" src="https://static.xx.fbcdn.net/rsrc.php/v3/yC/r/aMltqKRlCHD.png" alt="app-facebook" width="auto" height="auto">Facebook</button>
               </a>
            </div>
	
            
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
         </form>
      </div> <!-- /container -->	
       
       <div class="container">

         <form method="POST" action="valida.php" class="form-signin">
            <h2 class="form-signin-heading">Entre na sua conta</h2>
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
            
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
            <div style="display: flex; margin: 0 0 10px 0" >
               <span style=" margin: 0 auto 0 0" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="margin-top: 20px;"></span>
               <a style=" margin: 0 0 0 auto" href="<?php echo $loginUrl; ?>">
                  <button type="button" class="btn btn-primary">
                     <img class="_5h0l img" src="https://static.xx.fbcdn.net/rsrc.php/v3/yC/r/aMltqKRlCHD.png" alt="app-facebook" width="auto" height="auto">Facebook</button>
               </a>
            </div>
	
            
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
         </form>
      </div> <!-- /container -->	
       
       
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>