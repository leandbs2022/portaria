<?php

session_start();

//conexão a classes

require('./class/class.site.php');

$db = new site;

//variaveis

$confirme = "";

$senha= "";

$code= "";

?>

<!DOCTYPE html>

<html lang="pt=br">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>-->

    <link rel="icon" type="image/x-icon" href="/img/favico.ico">

    <?php
    if ($_SESSION["estilo"] === 0) {
      echo ' <link rel="stylesheet" href="css/pages.css">';
    } else {
       echo ' <link rel="stylesheet" href="css/pages1.css">';
    }
    ?>

    <script src="js/script.js"></script>

    <script language="javascript" src="js/funcoes.js"></script>

    <title>recuperar senha</title>

</head>

<body style="background-color:#2E2E2E;">

    <header class="container">

        <div class="mt-md-1">

            <div class="row ajuste">

                <h1 class="alert alert-primary titulo centro borda fontebranca">Confirmação de conta</h1>

                <form method="post" id="recuperar" action="" oninput="">

                <fieldset id="cliente">

                    <legend class='fontebranca'>Recuperar</legend>

                    <p><label class='fontebranca'>Código:</label><input type="text" class="bordasimples" name="tcod" id="ccod" size="5" maxlength="5" placeholder="code"></p>

                    <p><label class='fontebranca'>Senha:</label><input type="password" class="bordasimples" name="tsenha" id="csenha" value="" size="8" maxlength="8" placeholder="senha"><input type="password" class="bordasimples" name="tconfime" id="tconfirme" size="8" maxlength="8" placeholder="Confirme"></p>

                    <p><input type="submit" class="button" id="crecuperar" name="trecuperar" value="Enviar"> </p>

                </fieldset>

                <?php

                 if (isset($_POST['trecuperar'])) {

                    $senha = $_POST['tsenha'];

                    $confirme = $_POST['tconfime'];

                    $code=$_POST['tcod'];

                    if(empty($code)){

                        echo "<script>alert('Digite o Código!')</script>";

                    }else{

                    $resposta = $db->alterar_senha($senha,$code,$confirme);

                    }

                }

                ?>

                </form>

            </div>

        </div>

    </header>

</body>



</html>