<?php
session_start();
//$estilo = $_SESSION["estilo"];

session_unset();
session_destroy();
session_start();
//conexão a classes
require('./class/class.site.php');
//conexão DB
require('./conect.php');
$db = new site;
//variaveis globais
$_SESSION["nome"] = "";
$_SESSION["perfil"] = 0;
$_SESSION['data'] = "";
$_SESSION['nivel'] = "";
$_SESSION[('pdf')] = "";
$_SESSION["nome_l"] = "";
$_SESSION['email_l'] = "";
$_SESSION['id_f'] = 0;
$_SESSION['op'] = "";
$_SESSION["impressão"] = "";
$_SESSION["estilo"] = 0;
$estilo = $_SESSION["estilo"];
//Variaveis
$nome = "";
$senha = "";
$cdate = date('d/m/Y')
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/package/dist/umd/popper.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <title>Login</title>
    <link rel=stylesheet href=css/login1.css>
    <style>
         body{
font-family: Arial, Helvetica, sans-serif;
background-image: url('./img/portaria2.jpg');
background-repeat: no-repeat;
background-size:auto;
background-position: center;
background-attachment: fixed;

}
    </style>
    <?php

 $estilotitulo = 'titulo centro borda fontebranca';
    ?>
</head>

<body>
    <form method="post" action="">
        <header class=container>
            <p id="#topo"></p>

        </header><br><br><br><br><br><br>
        <section class=container>
            <div class="mt-5">
                <div class="row">
                    <div class="wrapper fadeInDown">
                        <div id="formContent">
                            <div class="fadeIn first">
                                <img class="imagem_icon" src="img/security.jpg.png" id="icon" alt="User Icon" />
                            </div>
                            <label class="fontebranca" for="Login">Usuário:</label>
                            <input type="text" name="login" id="login" />
                            <label class='fontebranca' for="password">Password:</label>
                            <input type="password" name="password" id="password" />
                            <input type="submit" class="fadeIn fourth" id="entrar" name="entrar" value="Entrar"
                                onclick="">
                            <?php
                            if (isset($_POST['entrar'])) {
                                require("./conect.php");
                                $senha = $_POST['login'];
                                $nome = $_POST['password'];
                                if (empty($senha) || empty($nome)) {
                                    echo "<script>alert('Não e possível logar falta informações!')</script>";
                                } else {

                                    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE 1");

                                    if (mysqli_num_rows($query)) {
                                        $resposta = $db->login($senha, $nome);
                                        $resposta = $db->usuario_estilo($estilo,$nome);
                                    
                                    } else {
                                        $nome = "Administrador";
                                        $senha = "123admin";
                                        $cript = base64_encode($senha);
                                        $completo='Administrador';
                                        $perfil = 1;
                                        $email = "admin@empresa.com.br";
                                        $_SESSION["nome"] = $nome;
                                        $_SESSION["perfil"] = 1;
                                        $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `completo`,`perfil`, `email`) VALUES ('$nome','$cript','$completo','$perfil','$email')");
                                        echo "<script>alert('Esse e seu primeiro acesso. O usuario administrador foi criando a e senha 123admin. Apos o acesso favor mudar a senha para sua seguranca')</script>";
                                    }
                                }
                            }

                            ?>

                            <div id="formFooter">

                                <a class="underlineHover" href="recuperar.php">Esqueceu a senha?</a>

                            </div>



                        </div>

                    </div>
                </div>
            </div>
    </form>
    </section>

    <footer id="rodape">
        <p class="container"><?php $resposta = $db->contador_ver(); ?></p>
    </footer>
</body>

</html>