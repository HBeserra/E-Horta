
<!doctype html>
<html lang="pt-br">
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

         
            
            <p id='msg'></p>
            
            <form method="POST" action="valida.php" class="form-signin">
                <?php
                session_start();
                    if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                    if(isset($_SESSION['msgcad'])){
                    echo $_SESSION['msgcad'];
                    unset($_SESSION['msgcad']);
                }
                ?>                
                <h2 class="form-signin-heading">Entre na sua conta</h2>
                <label class="sr-only">Email address</label>
                <input type="text" name="usuario" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
                <div style="display: flex; margin: 0 0 10px 0" >
                   <span style=" margin: 0 auto" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="margin-top: 20px;"></span>
                </div>



                <button class="btn btn-lg btn-primary btn-block" type="submit"  name="btnLogin" value="Acessar">Sign in</button>
                <a href="cadastrar.php">Crie grátis</a>
            </form>
          
          
      </div> <!-- /container -->			
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
		function onSignIn(googleUser) {
			var profile = googleUser.getBasicProfile();
			var userID = profile.getId(); 
			var userName = profile.getName(); 
			var userPicture = profile.getImageUrl(); 
			var userEmail = profile.getEmail(); 			 
			var userToken = googleUser.getAuthResponse().id_token; 
			
			//document.getElementById('msg').innerHTML = userEmail;
			if(userEmail !== ''){
				var dados = {
					userID:userID,
					userName:userName,
					userPicture:userPicture,
					userEmail:userEmail
				};
				$.post('valida_google.php', dados, function(retorna){
					if(retorna === '"erro"'){
						var msg = "<div class='alert alert-danger'>Não foi possivel entra com o google!</div>";
						document.getElementById('msg').innerHTML = msg;
					}else{
						window.location.href = retorna;
					}
					
				});
			}else{
				var msg = "<div class='alert alert-danger'>Não foi possivel entra com o google!</div>";
				document.getElementById('msg').innerHTML = msg;
			}
		}
		</script>
	</body>
</html>
