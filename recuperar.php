<?php

session_start();

//conexão a classes

require('./class/class.site.php');

// Instância da classe

$db = new site;

//variaveis

$mensagem = "";

$email = "";

$id= 0;

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

    <link rel="icon" type="image/x-icon" href="/img/favico.ico">

    <title>recuperar senha</title>

</head>



<body style="background-color:#2E2E2E;">

    <header class="container">

        <div class="mt-md-1">

            <div class="row ajuste">

                <h1 class="alert alert-success titulo centro borda fontebranca">Recuperar conta</h1>

                <form method="post" id="recuperar" action="" oninput="">
                    <fieldset id="recuperar">

                        <legend class='fontebranca'>Recuperar</legend>

                        <p><input type="email" class="bordasimples" name="tmail" id="cmail" size="20" maxlength="40" placeholder="digite o e-mail da sua conta">

                            <input type="submit" class="" id="crecuperar" name="trecuperar" value="enviar"> | <a href="index.php" class="fontebranca direita">ir para Login</a>


                        </p>

                    </fieldset>



                </form>

            </div>

        </div>

    </header>

    <?php

                    if (isset($_POST['trecuperar'])) {

                        $email = $_POST['tmail'];
                        $data = date('d-m-Y');
                        if (empty($email) || empty($data)) {
                            echo "<script>alert('Falta informações para enviar o código!')</script>";

                        } elseif ($email <> "") {

                            require("./conect.php");





                            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email='$email'") or die(mysqli_error($conn));



                            if (mysqli_num_rows($query)) {

                                while ($array = mysqli_fetch_row($query)) {

                                    $id = $array[0];

                                    echo "<script>alert('$id')</script>";

                                }

                                $comando = "SELECT * FROM recuperar WHERE id='$id' and dt = '$data' and valido='1'";

                            $query = mysqli_query($conn, $comando);

                            if (mysqli_num_rows($query)) {



                                while ($array = mysqli_fetch_row($query)) {

                                    $mensagem = $array[1];

                                    $resposta = $db->EnviarMail($mensagem, $email);

                                }



                            } else {

                                $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

                                $max = strlen($caracteres) - 1;

                                $code = "";

                                for ($i = 0; $i < 5; $i++) {

                                    $code .= $caracteres[mt_rand(0, $max)];

                                }

                                $mensagem = $code;



                                $resposta = $db->gravacode($id, $data, $code);

                                $resposta = $db->EnviarMail($mensagem, $email);

                            }

                            }else{

                                echo "<script>alert('O usuário não encontrado!')</script>";

                            }

                        } else {

                            echo "<script>alert('Não existe código valido para esse usuário!')</script>";

                        }

                    }

                    ?>

</body>



</html>