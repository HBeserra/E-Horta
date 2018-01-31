<?php
session_start();
//var_dump($dados);
$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

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

$mail->Subject = "Codigo de Verificação da sua conta"; 
$mail->Body = ("Seu codigo".$num."<br>"."Valido até ".$data_validade);

$_SESSION['msg'] = "Email enviado com Sucesso!";

if(!$mail->Send())
    $_SESSION['msg'] = "Erro ao enviar Email:".$mail->ErrorInfo;
    header("Location: cadastrar.php");

//==========================================================================

$result_usuario = "INSERT INTO verificação (nome, sobrenome, email, usuario, senha, email_enviado, Código_Valido, data_pedido, data_validade) VALUES (
                '" .$dados['nome']. "',
                '" .$dados['sobrenome']. "',
                '" .$dados['email']. "',
                '" .$dados['usuario']. "',
                '" .$dados['senha']. "',
                '1',
                '" .$num. "',
                '" .$date. "',
                '" .$data_validade. "'
                )";
$resultado_usario = mysqli_query($conn, $result_usuario);
if(mysqli_insert_id($conn)){
    $_SESSION['msgcad'] = ("Verifique seu email! Codigo valido até " . $data_validade);
    header("Location: login.php");




/*
$result_usuario = "INSERT INTO verificação (nome, email, usuario, senha, email_enviado, Código_Valido, data_pedido, data_validade) VALUES (
                '" .$dados['nome']. "',
                '" .$dados['email']. "',
                '" .$dados['usuario']. "',
                '" .$dados['senha']. "'
                )";
$resultado_usario = mysqli_query($conn, $result_usuario);
if(mysqli_insert_id($conn)){
    $_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
    header("Location: login.php");


$a = substr($num, 0, 3);
$b = substr($num, 3, 6);













/*$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

$result_usuario = "INSERT INTO usuarios (nome, email, usuario, senha, email_enviado, Código_Valido) VALUES (
                '" .$dados['nome']. "',
                '" .$dados['email']. "',
                '" .$dados['usuario']. "',
                '" .$dados['senha']. "'
                )";
$resultado_usario = mysqli_query($conn, $result_usuario);
if(mysqli_insert_id($conn)){
    $_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
    header("Location: login.php");
*/
  
?>
