<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PORTARIA</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!--jQuery-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.uikit.min.css">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/sl-1.6.2/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.jqueryui.min.js"></script>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--css-->
    <link rel="stylesheet" href="css/portaria.css">
    <script src="js/funcoes.js"></script>
    <!--PHP-->
    <?php
	session_start();
	//conexão a classes
	require './class/class.site.php';
    require './class/class.restrigir.php';
	$db = new site;
    $db_r = new restrigir;
	//perfil de acesso
	$permissao = $_SESSION["perfil"];

	//variaveis
	$nome = $_SESSION["nome"];
    $nivel = $_SESSION['nivel'];

	if ($nome == "") {
		header("Location: index.php");
		exit;
	}
		$iframe = "hidden";

        //variaveis
        date_default_timezone_set('America/Sao_Paulo');
        $iframe = 1;
        $dataD = (date('d-m-Y H:i:s'));
        $restrigir = "0";
        $cor = "";
        $cpf = "";
        $rg =  "";
        $check = '0';

        
	?>
    <script>
    function vigilante() {
        window.location.href = usuarios.php;
    }
    </script>
    <style>
    body {
        background-image: url('img/tela/seguranca1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    </style>
</head>

<body>
    <header class='container-fluir' id='topo'>
        <?PHP ECHO "<p class=titulo> <b>Usuário: $nome | Acesso: $nivel </b></p>" ;?>
        <h1 class='centro'>
            <?php echo"<div class='alert alert-light title border_title'>CONTROLE DE ENTRADA </div>"; ?>
        </h1><br>
        <div class="wrapper fadeInDown">

            <div class='menu01'>
                <div class="btn btn-light balanco ">
                    <a href="visitante.php"><button type="button" class="btn btn-light balanco">Resgistrar
                            entrada</button></a>
                    <!-- <a href="usuarios.php"><button type="button" class="btn btn-light balanco left"
                            data-bs-toggle="modal" data-bs-target="#">Resgistrar Vigilante</button></a>-->
                    <a href="tela.php"><button type="button" class="btn btn-light balanco left" data-bs-toggle="modal"
                            data-bs-target="#">Configurações e segurança</button></a>
                            <a href="autorizar.php"><button type="button" class="btn btn-light balanco left" data-bs-toggle="modal"
                            data-bs-target="#">Autorização do dia</button></a>
                            <a href="ramal.php"><button type="button" class="btn btn-light balanco left" data-bs-toggle="modal"
                            data-bs-target="#">Ramais importantes</button></a>
                    <a href="login.php"><button type="button" class="btn btn-light balanco">Trocar de login</button>
                        <a href="index.php"><button type="button" class="btn btn-light balanco">Bloquear tela</button>
                        </a>
                </div>
            </div>
            <div class="card card-body">
                <div class="container-fluir titulo">
                    <b class="balanco direita">DIGITE : RG | NOME | PLACA | DATA VISITA</b><br>
                    <table id="listar-usuario" class="display" style="width:100%">
                        <tr><b>Pesquisa rápida</b><br></tr>
                        <thead>
                            <tr>
                                <th>NOME</th>
                                <th>DESTINO</th>
                                <th>PLACA</th>
                                <th>MODELO</th>
                                <th>COR</th>
                                <th>EMPRESA</th>
                                <th>PORTARIA</th>
                                <th>DATA</th>
                                <th>VIGILANTE</th>
                                <th>RESUMO VISITA</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <script>
                $(document).ready(function() {
                    $('#listar-usuario').DataTable({

                        language: {
                            url: 'pt-BR.json',
                        },

                        columnDefs: [{
                                target: 0,
                                visible: true,
                                searchable: true,
                            },

                            {
                                target: 1,
                                visible: true,
                            },

                            {
                                target: 2,
                                visible: true,
                            },

                        ],
                        "Search": "",
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "proc_pesq_user.php",
                            "type": "POST"
                        }
                    });
                });

                $('form').submit(function() {
                    $(this)[0].reset();
                });
                </script>
            </div>
            <?php 
        if (isset($_POST['registro'])) {
            if ($permissao == 5 || $nivel=="Usuário avançado") {header("Location: alterar_ramal.php");}else{echo "<script> alert('Acesso negado')</script>";}
            }
        ?>
           
                <footer class='alert alert-light' id='rodape'>&reg;Desenvolvido por Leandro Barbosa de Souza - <a
                        href="https://lbscode1.websiteseguro.com/projetos/portfolio/" target="_blank">Portfólio </a></footer>
    
    </header>

    <section id='ramal'>
        <div class="collapse" id="ramal">
            <div class="card card-body">
                <?php

require("./conect.php");
$query = mysqli_query($conn, "SELECT * FROM ramal WHERE 1")  or die(mysqli_error($conn));;
if (mysqli_num_rows($query)) {
    $estilos[0] = "background-color: #BDBDBD;font-size:18px;color:black;font-style:bold;font-family:Arial;text-align:left; width: 50%;";
    echo "<table style=\"width:auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
    <td style=\"$estilos[0]\">NOME</td>
    <td style=\"$estilos[0]\">RAMAL</td>
    </tr>";
    $color ="";
    while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
        $estilos[1] = "background-color:{$color};font-size:18px;color:black;font-style:bold;font-family: Times New Roman, Times, serif;text-align: left; width: 50%;  border: 1px solid #0a0a0a;";
        echo "<tr>
        <td style=\"$estilos[1]\">$array[1]</td>
        <td style=\"$estilos[1]\">$array[2]</td>
        </tr>";
    }
}
?>
            </div>
        </div>
    </section>


</body>

</html>