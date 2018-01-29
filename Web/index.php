<?php
if(array_key_exists('Alertas_Horta',$_COOKIE) )
{
$_SESSION['msg'] = "X";
} else {
setcookie("Alertas_Horta", "x");

}
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
       <link rel="shortcut icon" href="http://www.horta.tk/img/logo%20ehorta.png">


      <title>E-Horta</title>
   </head>
   <body>
      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
         <a class="navbar-brand" href="http://www.horta.tk/">
            <img src="http://www.horta.tk/img/e-horta%20home.png" width="auto" height="50" alt="www.horta.tk">
         </a>
         <div class="collapse navbar-collapse" id="navbar-home">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item">
                  <a class="nav-link" href="#">Projeto</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Sobre</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link disabled" href="#">GitHub</a>
               </li>
            </ul>
            <a href="http://www.web.horta.tk"><button  type="button" class="btn btn-secondary">Login</button></a>
         </div>
      </nav>
   <main style="margin: 75px 0 0 0" role="main">


         
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron .bg-dark">
        <div class="container">
          <h1 class="display-3">Hello, world!</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Descubra »</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
          </div>
        </div>
         
         
         <div class="row">
          <div class="col-md-8">
            <img style="width: 100%" src="http://www.horta.tk/img/grafico-evolucao.png" />
          </div>
          <div class="col-md-4">
             <h2> </h2>
            <p>Analisamos os dados e levamos a você informações preciosas sobre sua horta criando previsões valiosas.</p><p>A agricultura industrial já vem se beneficiando da predicabilidade estimando gastos e lucros com auxílio da meteorologia, beneficie-se também.</p>
            <p><a class="btn btn-secondary" href="#" role="button">Veja Mais »</a></p>
          </div>
        </div>
         <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <h2 class="mx-auto">Aplicativo</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
             <iframe width="100%" height="auto" src="https://www.youtube.com/embed/Bey4XXJAqS8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            <p><a class="btn btn-secondary" href="#" role="button">Donwload »</a></p>
          </div>
          <div class="col-md-3">
          </div>
        </div>
         
        <hr>

      </div> <!-- /container -->

    </main>
      
      <div style="top: 80px; width: 80%; margin: 0 auto"  class="fixed-top" >
         
         <?php 
if(!empty($_SESSION['msg'])){

} else {

   echo "<div class='alert alert-primary' role='alert'>
            Atualização - V:.3.1.4!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
            </button>
         </div>";
   
 echo "<div class='alert alert-danger' role='alert'>
            <strong>Sistema Inoperante!</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
            </button>
         </div>";
   
}
         ?>
         
         
         
      </div>
      

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
   </body>
</html>