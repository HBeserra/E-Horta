<?php

session_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['email'], $_SESSION['Code']);

$_SESSION['msg'] = "Deslogado com sucesso";
header("Location: http://horta.tk/");