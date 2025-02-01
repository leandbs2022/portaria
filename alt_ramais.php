<?php
session_start();
//conexão a classes
require './class/class.site.php';
$db = new site;
//perfil de acesso
$permissao = $_SESSION["perfil"];
//variaveis
$nome = $_SESSION["nome"];
$resposta = $db->load_estilo($nome);
$estilo =1;
if ($nome == "") {
    header("Location: index.php");
    exit;
}
//variaveis
$ativa = 0;
$id_alt =  "";
$user =  "";
$ram =  "";
$dep =  "";
$email = "";
$descr = "";
$local = "";
$ativo = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações importantes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/infor.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <?php

    $nome = $_SESSION["nome"];
    $resposta = $db->load_estilo($nome);
    if ($estilo == 0) {
        echo ' <link rel="stylesheet" href="css/pages.css">';
    } else {
        echo ' <link rel="stylesheet" href="css/pages1.css">';
    }
    if ($nome == "") {
        header("Location: index.php");
        exit;
    }
    ?>
    <?php

    if (isset($_POST['tdepart'])) {
        if ($permissao == 1 || $permissao == 5) {
            $dep = $_POST['tcategoria'];
            $ativa = $_POST['tativa'];
            $infor = $db->add_dep($dep, $ativa);
            header("refresh: 0");
        } else {
            echo "<script> alert('Acesso negado!Apenas administradores podem cadastrar.')</script>";
        }
    }

    if (isset($_POST['tlocal'])) {
        if ($permissao == 1 || $permissao == 5) {
            $local = $_POST['tcategoria2'];
            $infor = $db->add_local($local);
            header("refresh: 0");
        } else {
            echo "<script> alert('Acesso negado!Apenas administradores podem cadastrar.')</script>";
        }
    }



    if (isset($_POST['tcat'])) {
        if ($permissao == 1 or $permissao == 5) {
            $user = $_POST['tuser1'];
            $ram = $_POST['tram1'];
            $dep = $_POST['tcmbcat'];
            $email = $_POST['temail'];
            $descr = $_POST['tcmbcat4'];
            $user = mb_strtoupper($user);
            $dep = mb_strtoupper($dep);
            $email = mb_strtoupper($email);
            $descr = mb_strtoupper($descr);
            $adicionar = $db->add_ramal($user, $ram, $dep, $email, $descr);
            $link = $db->visiualzar_ramal($user);
            header("refresh: 0");
        } else {
            echo "<script> alert('Acesso negado!Apenas administradores podem cadastrar.')</script>";
        }
    }


    if (isset($_POST['talt'])) {
        if ($permissao != 1 or $permissao != 5) {
            $id = $_POST['tid2'];
            echo "<script> alert('$id')</script>";
            $user = $_POST['tuser2'];
            $ram = $_POST['tram2'];
            $dep = $_POST['tcmbcat2'];
            $email = $_POST['temail2'];
            $descr = $_POST['tobs2'];
            $priv = ( isset($_POST['tpriv2']) ) ? true : null;
            $user = mb_strtoupper($user);
            $dep = mb_strtoupper($dep);
            $email = mb_strtoupper($email);
            $descr = mb_strtoupper($descr);
            $adicionar = $db->alt_ramal($id, $user, $ram, $dep, $email, $descr,$priv);
            header("refresh: 0");
        } else {
            echo "<script> alert('Acesso negado!Apenas administradores podem cadastrar.')</script>";
        }
    }

    if (isset($_POST['tsair2'])) {
        header("refresh: 0");
    }
    ?>

</head>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Usuário: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control w-auto" type="text" id="cuser" name="tuser1" maxlength="25" value="">
                        </div>
                        <label class="col-sm-2 col-form-label">Ramal: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control w-auto" type="number" id="cram" name="tram1" maxlength="10" value="">
                        </div>

                        <label class="col-sm-2 col-form-label">Dep: </label>
                        <div class="col-sm-10 mb-3">
                            <select id="cmbcat1" name="tcmbcat" class="form-control-sm fontecombo">
                                <option></option>
                                <?php
                                require "./conectar.php";
                                $query = mysqli_query($conn, "SELECT DISTINCT dep,ativa from dep where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array = mysqli_fetch_row($query)) {
                                        if ($array[1] == 1) {
                                            echo "<option>{$array[0]}</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal4">Novo dep</button>
                        </div>

                        <label class="col-sm-2 col-form-label">E-mail: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control w-auto" type="email" id="cemail" name="temail1" value="">
                        </div>

                        <label class="col-sm-2 col-form-label">Local: </label>
                        <div class="col-sm-10 mb-3">
                            <select id="cmbcat14" name="tcmbcat4" class="form-control-sm fontecombo">
                                <option></option>
                                <?php
                                require "./conectar.php";
                                $query = mysqli_query($conn, "SELECT * from locais where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array = mysqli_fetch_row($query)) {

                                        echo "<option>{$array[1]}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal5">Novo local</button>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="tsair">Sair</button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href=''" name="tcat">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal dep-->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de departamentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dep: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="ccategoria" name="tcategoria" value="">
                        </div>
                        <label class="col-sm-2 col-form-label mb-2">Ativa: </label>
                        <div class="col-sm-10 mb-3">
                            <select class="form-select" aria-label="" name="tativa" id="cativa">
                                <option value="1">Ativa</option>
                                <option value="0">Desativada</option>
                            </select>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="tsair">Sair</button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href='#'" name="tdepart">Salvar</button>
            </div>
        </div>
    </div>

</div>
<!-- Modal local-->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de localização</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Local: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="ccategoria2" name="tcategoria2" value="">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="tsair1">Sair</button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href='#'" name="tlocal">Salvar</button>
            </div>
        </div>
    </div>

</div>
<!-- Modal1 -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="post" id="insert_form">
                    <?php
                    $user = $_POST['tcmbcat1'];
                    if (empty($user)) {
                        $_SESSION["id_user"] = 0;
                        $_SESSION["user_alt"] = "";
                        $_SESSION["ram_alt"] = "";
                        $_SESSION["dep_alt"] = "";
                        $_SESSION["email_alt"] = "";
                        $_SESSION['descr_alt'] = "";
                    }

                    $link = $db->pes_ramal($user);
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="cid">ID: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cid" name="tid" value="<?php echo $_SESSION["id_user"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="cuser">Usuário: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cuser" name="tuser" maxlength="25" value="<?php echo $_SESSION["user_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="cram">Ramal: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="number" id="cram" name="tram" maxlength="10" value="<?php echo $_SESSION["ram_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="cdep">Dep: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cdep" name="tdep" value="<?php echo $_SESSION["dep_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="cemail">E-mail: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="email" id="cemail" name="temail" value="<?php echo $_SESSION["email_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="cobs">Local: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cobs" name="tobs" maxlength="50" value="<?php echo $_SESSION['descr_alt']; ?>">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="tsair">Sair</button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href=''" name="talt">Confirmar alteração</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" onload="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <?PHP
                    $user = $_POST['tid'];
                    $ativo = 3;
                    if (empty($user)) {
                        $_SESSION["id_user"] = 0;
                        $_SESSION["user_alt"] = "";
                        $_SESSION["ram_alt"] = "";
                        $_SESSION["dep_alt"] = "";
                        $_SESSION["email_alt"] = "";
                        $_SESSION['descr_alt'] = "";
                    }
                    $link = $db->pes1_ramal($user, $ativo);
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ID: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cid" name="tid2" value="<?php echo $_SESSION["id_user"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label">Usuário: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cuser" name="tuser2" value="<?php echo $_SESSION["user_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label">Ramal: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="text" id="cram" name="tram2" value="<?php echo $_SESSION["ram_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label">Dep: </label>
                        <div class="col-sm-10 mb-3">
                            <select id="cmbcat1" name="tcmbcat2" class="form-control-sm fontecombo">
                                <option><?php echo $_SESSION["dep_alt"]; ?></option>
                                <?php
                                require "./conectar.php";
                                $query = mysqli_query($conn, "SELECT DISTINCT * from dep where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array1 = mysqli_fetch_row($query)) {
                                        $cliente = $array1[1];
                                        echo "<option>{$cliente}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">E-mail: </label>
                        <div class="col-sm-10 mb-3">
                            <input class="form-control" type="e-mail" id="cemail" name="temail2" value="<?php echo $_SESSION["email_alt"]; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label">Local: </label>
                        <div class="col-sm-10 mb-3">
                            <select id="tobs2" name="tobs2" class="form-control-sm">
                                <option><?php echo $_SESSION['descr_alt']; ?></option>
                                <?php
                                require "./conectar.php";
                                $query = mysqli_query($conn, "SELECT * from locais where 1");
                                if (mysqli_num_rows($query)) {
                                    while ($array = mysqli_fetch_row($query)) {

                                        echo "<option>{$array[1]}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Privado: </label>
                        <div class="col-sm-10 mb-3">
                            <div class="form-check">
                            <?php $priv =""; if($_SESSION["priv"] == 1){ $priv ="checked";}else{$priv ="";} ?>
                                <input class="form-check-input" type="checkbox" name="tpriv2" value="" id="flexCheckChecked" <?php echo $priv; ?>>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="tsair2">Sair</button>
                <button type="submit" class="btn btn-primary" onclick="window.location.href=''" name="talt">Confirmar alteração</button>
            </div>
        </div>
    </div>
</div>

<body>
    <fieldset id="ramais" class="border border-1 border-dark rounded p-2 h-100">
        <legend class="fontebranca">Dados dos ramais</legend>
        <div class="input-group mb-3">
            <!--<select id="cmbcat1" name="tcmbcat1" class="form-control-sm">
                <option>Selecione</option>
                <?php
                require "./conectar.php";
                $query = mysqli_query($conn, "SELECT DISTINCT loc from locais where 1");
                if (mysqli_num_rows($query)) {
                    while ($array1 = mysqli_fetch_row($query)) {
                        $cliente = $array1[0];
                        echo "<option>{$cliente}</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" id="cloc" name="tloc" value="" onclick="window.location.href=''" class="btn btn-outline-secondary btn-sm">Localizar</button>
            -->
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo</button>
            <p class="mb-2"></p>
            <button type='submit' name='tadic' class='btn btn-outline-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal2'>Alterar</button>
            <input type='NUMBER' class='form-control-sm' style="width:auto;" id='cid' name='tid' size='6' sizemax='4' placeholder='digite ID'><button type="button" onclick="window.location.href='impressao_impr2.php'" class="btn btn-outline-secondary btn-sm">Gerar relatório em excel</button>
        </div>

        <div class="input-group mb-3 flex-lg-row">
            <?php

            if (isset($_POST['tadic'])) {
                if ($permissao == 1 or $permissao == 5) {
                    $ativo = 1;
                    $user = $_POST['tid'];
                    $link = $db->pes1_ramal($user, $ativo);
                } else {
                    echo "<script>alert('acesso negado');</script>";
                }
            }


            if (isset($_POST['tloc'])) {
                $user = $_POST['tcmbcat1'];
                $link = $db->visiualzar_tables($user);
                $link = $db->pes_ramal($user);
            }
            ?>
        </div>
        <div>
		<table id="listar-usuario" class="table table-striped border border-1">
			<thead>
				<tr>
                <th>ID</th>
                    <th>Nome</th>
                    <th>Ramal</th>
                    <th>E-mail</th>
				</tr>
			</thead>
		</table>
        <script>
		$(document).ready(function() {
			$('#listar-usuario').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "proc_pesq_user1.php",
					"type": "POST"
				}
			});
		});
	</script>
	</div>
    </fieldset>
</body>

</html>