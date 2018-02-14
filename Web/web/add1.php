<?php
session_start();
?>
<html lang="pt-br"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://horta.tk/img/logo-ehorta.ico">

        <title>Configuração | E-Horta</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
        <script type='text/javascript' src='mqtt/mosquitto.js'></script>
<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.2.min.js'></script>
    </head>
    <body>
        <div class="container">
                        <form class="form-signin">
                <h2>Adicionar a conta</h2>
                <br>
                <p id="pr">
                 Pressione o botão em seu e-horta para<strong> confirmar </strong>sua indentidade.
                </p>
                
                <a href="#">Ajuda com o ID do seu e-horta?</a>
                <!-- <div id="#debug"></div> -->
                
            </form>
        </div> <!-- /container -->	
        <script type="text/javascript">
            (function() {
                window.Main = {};
                Main.Page = (function() {
                    var mosq = null;
                    function Page() {
                        var _this = this;
                        mosq = new Mosquitto();

                        mosq.onconnect = function(rc){
                            var p = document.createElement("p");
                            p.innerHTML = "Conectado ao Broker!";
                            $("#debug").append(p);
                            mosq.subscribe("<?php echo $_SESSION['ID']; ?>/outTopic", 0);

                        };
                        mosq.ondisconnect = function(rc){
                            var p = document.createElement("p");
                            var url = "ws://192.168.1.3:8000/mqtt";

                            p.innerHTML = "A conexão com o broker foi perdida";
                            $("#debug").append(p);				
                            mosq.connect(url);
                        };
                        mosq.onmessage = function(topic, payload, qos){
                            var p = document.createElement("p");
                            var acao = payload;
                            console.log(payload);
                            if(payload[0] == "K"){

                                ur = ("/git/E-Horta/Web/web/add2.php?payload=" + payload);
                                window.alert(ur);
                                window.location.href = ur;
                            }
                        };
                    }
                    window.onload = function(e){ 
                        console.log("start"); 
                        var url = "ws://192.168.1.3:8000/mqtt";
                        mosq.connect(url);
                        mosq.subscribe("<?php echo $_SESSION['ID']; ?>/outTopic", 0);
                    }
                    return Page;
                })();
                $(function(){
                    return Main.controller = new Main.Page;
                });
            }).call(this);
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>