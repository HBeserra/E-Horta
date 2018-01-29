<?php
session_start();
if(!empty($_SESSION['id'])){
   echo "Olá ".$_SESSION['nome'].", Bem vindo <br>";
   include_once("dashboard.php");
   echo "<a href='sair.php'>Sair</a>";
}else{
   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
   header("Location: login.php");	
}

