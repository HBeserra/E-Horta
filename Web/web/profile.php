<?php
session_start();
if(!empty($_SESSION['id'])){
   include_once("perfil.php");
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}else{
   $_SESSION['msg'] = "<div class='alert alert-danger'>Área restrita!</div>";
   header("Location: login.php");	
}
