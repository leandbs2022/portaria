<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Ramais</title>
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/baseclaro.css">
    <script src="js/funcoes.js"></script>

    <?php
	session_start();
	//conexão a classes
	require './class/class.site.php';
	$db = new site;
	$iframe = 1;
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
	?>

</head>

<body onload="alert('versão de teste, dados fictícios')">
    <div class="wrapper fadeInDown">
        <header class='container-fluir'>
            <div class='titulo'></div>
            <P>
                <?PHP ECHO "<p class=titulo> <b>Usuário: $nome | Acesso: $nivel </b></p>" ;?>
            </P>
            <h1 class='centro'><?php echo"<div class='alert alert-secondary ' class=title> RAMAIS</div>"; ?>
            </h1>
            <p class='direita titulo'> <b>DIGITE : NOME DEP CARGO GRUPO</b></p>
        </header>
            
        <div class="container-fluir titulo">
            <table id="listar-usuario" class="display" style="width:100%">
                <tr></tr>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ramal</th>
                        <th>E-mail</th>
                        <th>Grupo</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="container-fluir titulo">
            <form action="" method="post">

                <div>
                    <input type="submit" name="registro" id="registro" class="btn btn-secondary" value="NOVO REGISTRO">
                    <a class='btn btn-secondary' href=index.php>BLOQUEAR TELA INCIAL</a>


                </div>

            </form>
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
                    "url": "proc_pesq_user_ramal.php",
                    "type": "POST"
                }
            });
        });

        $('form').submit(function() {
            $(this)[0].reset();
        });
        </script>
        <?php 
        if (isset($_POST['registro'])) {
            if ($permissao == 1|| $nivel=="Administrador") {header("Location: alterar_ramal.php");}else{echo "<script> alert('Acesso negado')</script>";}
            }
        ?>
        <div class="space-around">

            <div id='box'></div>
            <div id='box'></div>
            <div id='box'> </div>
            <div id='box'></div>
            <div id='box'></div>
            <div id='box'><img id='' src="./img/mda.jpg" alt=""></div>
            <div id='box'><img id='' src="./img/mapa.jpg" alt=""></div>
        </div>

        <footer class='alert alert-secondary'>&reg;Desenvolvido por Leandro Souza
        </footer>
    </div>
</body>

</html>