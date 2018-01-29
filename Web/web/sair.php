<?php

session_start();
unset($_SESSION['id'], 
	  $_SESSION['nome'],
	  $_SESSION['email'], 
	  $_SESSION['key_word'], 
	  $_SESSION['foto_perfil'], 
	  $_SESSION['acesso'],
	  $_SESSION['dashboard'],
	  $_SESSION["foto_perfil"],	  
	  
	  $_SESSION['titulo'], 
	  $_SESSION['canal_dados'],
	  $_SESSION['api_key_dados'],
	  $_SESSION['canal_verificação'],
	  $_SESSION['field_verificação'],
	  $_SESSION['api_key_verificação'],
	  
	  $_SESSION['Horta_id_1'],
	  $_SESSION['Horta_id_2']
	 );

$_SESSION['msg'] = "Deslogado com sucesso";
header("Location: /index.html");