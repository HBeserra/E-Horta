<?php

session_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['email'], $_SESSION['Code'], $_SESSION['Device-ID'], $_SESSION['Device-Token']);

$_SESSION['msg'] = "<div class='alert alert-info'>Deslogado com sucesso</div>";
header("Location: http://horta.tk/");