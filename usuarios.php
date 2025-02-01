<?php

session_start();
//conexão a classes
require('./class/class.site.php');
$db = new site;
$resposta = $db->validar();
//variaveis
$completo ="";
$nome =  "";
$senha = "";
$perfil = "";
$email = "";
$deletar = false;
$permissao = $_SESSION["perfil"];

?>
<!DOCTYPE html>
<html lang="pt=br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $nome = $_SESSION["nome"];
    $resposta = $db->load_estilo($nome);
    $estilo = $_SESSION["estilo"];
    $nivel_acesso = $_SESSION['perfil'];
    if ($nivel_acesso != 1) {
        echo "<script>alert('Essa e uma area restrita apenas a administradores.')</script>";
        header("Location:tela.php");
        exit;
    }
    ?>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="icon" type="image/x-icon" href="/img/favico.ico">
    <script src="js/script.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Cadastro de Usuários</title>
    <style>
   body {
    background-image: url('img/visitante.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
    </style>
</head>

<body onload="cal_total()" class="container-fluir">
    <?php
    if (isset($_POST['tlocaliza'])) {
        $nome = $_POST['tloc'];
        $resposta = $db->localizar_usuario($nome);
        $email = $_SESSION['email_l'];
        $nome =  $_SESSION["nome_l"];
        $perfil = $_SESSION["perfil_l"];
        $completo = $_SESSION["completo_l"];
    }
    ?>
    <div class="quadro">
    <header class="container">
        <div class="mt-md-1">
            <div class="row ajuste">
                <h1 class="titulo">USUÁRIOS</h1>
            </div>
        </div>
    </header>

    <form method="post" action="" id="cform" class="container">
        <div class="mt-md-1">
            <div id="usuarios" class="row">
                <div class="form bordar_div_p">
                <div class="bordar_div_p">  
                <label>Identificação do Usuário</label>
                    <p><label class='fontebranca'>Nome: </label><input type="text" class="bordasimples " name="tcompl"
                            id="ccompl" value="<?php echo $completo; ?>" size="" maxlength="40">
                    </p>
                    </div>  
                    <div class="bordar_div_p">  
                    <p><label class='fontebranca'>Login: </label><input type="text" class="bordasimples " name="tnome"
                            id="cnome" value="<?php echo $nome; ?>" size="20" maxlength="20"></p>

                    <p><label class='fontebranca'>Senha:</label><input type="password" class="bordasimples"
                            name="tsenha" id="csenha" value="" size="8" maxlength="8"></p>
                    <p><label class='fontebranca'>Confirmar:</label><input type="password" class="bordasimples"
                            name="tconfimr" id="tconfirme" size="8" maxlength="8" placeholder="Confirme"></p>
                    <p><label class='fontebranca'>E-mail:</label><input type="text" class="bordasimples" name="tmail"
                            id="cmail" size="20" maxlength="40" value="<?php echo $email; ?>"></p>
                        <label>Perfil</label>
                        <select class="form-select" aria-label="Default" id="cper" name="tper">
                            <?php
                                $perfilb = '';
                                switch ($perfil) {
                                    case '1':
                                        $perfilb = 'Administrador';
                                        break;
                                        exit;
                                    case '5':
                                        $perfilb = 'Vigilante';
                                        break;
                                        exit;
                                }
                                echo "<option>{$perfilb}</option>";
                                ?>
                            <option value="1"> Administrador</option>
                            <option value="5"> Vigilante</option>
                        </select>
                        </div>
                        <div class="menu">
                            <input type="submit" class="btn btn-light balanco espaco" id="ccadastro" name="tcadastro"
                                value="Novo">
                            <input type="submit" class="btn btn-light balanco espaco" id="calt" name="talt"
                                value="Alterar">
                            <input type="submit" class="btn btn-light balanco espaco" id="cdel" name="tdel"
                                value="Deletar">
                            
                            <input type="submit" class="btn btn-light balanco espaco" id="clocaliza" name="tlocaliza"
                                value="Localizar">
                            <select id="cloc" name="tloc" class="form-select w-auto espaco" aria-label="Default ">
                                <option></option>
                                <?php
                                require("./conect.php");
                                $query = mysqli_query($conn, "SELECT * from usuarios where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array1 = mysqli_fetch_row($query)) {
                                        $direto = $array1[1];
                                        echo "<option>{$direto}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <a class="btn btn-light espaco direita" href="tela.php"><button type="button"
                                    class="btn btn-light balanco espaco direita">Voltar a configurações</button></a>
                        </div>
                </div>
                <div>
                    <?php

                        if (isset($_POST['tcadastro'])) {
                            //dados campos
                            $perfil = $_POST['tper'];
                            $completo = $_POST['tcompl'];
                            $nome = $_POST['tnome'];
                            $senha = $_POST['tsenha'];
                            $confime = $_POST['tconfimr'];
                            $email = $_POST['tmail'];
                            if ($permissao == "1") {
                                if ($senha <> $confime) {
                                    echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
                                } else {
                                    if (empty($senha)) {
                                        echo "<script>alert('Você precisa confirmar sua senha.')</script>";
                                    } else {
                                        $resposta = $db->usuario_add($completo,$nome, $senha, $perfil, $email);
                                    }
                                }
                            } else {

                                echo "<script>alert('Você não tem permissão de adicionar usuário.')</script>";
                            }
                        }

                        if (isset($_POST['talt'])) {

                            $perfil = $_POST['tper'];
                            $completo = $_POST['tcompl'];
                            $nome = $_POST['tnome'];
                            $senha = $_POST['tsenha'];
                            $confime = $_POST['tconfimr'];
                            $email = $_POST['tmail'];
                            if ($permissao === "1") {
                                if ($senha <> $confime) {
                                    echo "<script>alert('A Senha não confere!Favor digite novamente.')</script>";
                                } else {

                                    if (empty($senha)) {
                                        echo "<script>alert('Você precisa confirmar sua senha.')</script>";
                                    } else {
                                        $resposta = $db->usuario_alt($completo,$nome, $senha, $perfil, $email);
                                    }
                                }
                            } else {

                                echo "<script>alert('Você não tem permissão para essa função.')</script>";
                            }
                        }

                        if (isset($_POST['tdel'])) {

                            if ($permissao == 1) {
                                $nome = $_POST['tnome'];
                                $resposta = $db->usuario_del($nome);
                            } else {

                                echo "<script>alert('Você não tem permissão para essa função.')</script>";
                            }
                        }

                        ?>

                </div>
            </div>
    </form>
    </div>
    </div>
    <script>
    /*
const text = document.querySelector('input[type="text"]');

text.addEventListener("focus", (event) => {
    event.target.style.background = "gray";
    if (document.getElementById("ccompl").value != ""){document.getElementById("ccompl").value = ""}
    if (document.getElementById("cnome").value != ""){document.getElementById("cnome").value = ""}
    if (document.getElementById("csenha").value != ""){document.getElementById("csenha").value = ""}
    if (document.getElementById("cmail").value != ""){document.getElementById("cmail").value = ""}
  });
  text.addEventListener("blur", (event) => {
    event.target.style.background = "";
  });
/*
    </script>

</body>



</html>