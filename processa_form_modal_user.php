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

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
// Pegando os dados do formulário
    $completo = $_POST[ 'ccomp' ] ;
    $nome = $_POST[ 'clog' ] ;
    $senha = $_POST[ 'csenha' ] ;
    $conf = $_POST[ 'cconf' ] ;
    $email = $_POST[ 'cemail' ] ;
    $perfil = $_POST[ 'cnivel' ] ;
    $desativar = ( isset( $_POST[ 'rest' ] ) ) ? true : 0;
    // Exemplo de gravação em variáveis ( pode ser gravado em banco de dados ou arquivo, dependendo da necessidade )
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('O usuário ja existe!')</script>";
            //$cript = base64_encode($senha);
            //$query = mysqli_query($conn, "UPDATE `usuarios` SET `senha`='$cript',`completo`='$completo',`perfil`='$perfil',`email`='$email',`estilo`=0,`desativar`='$desativar' WHERE `nome`='$nome'")  or die(mysqli_error($conn));
            header("Location: login.php");
            exit;
        } else {
            $cript = base64_encode($senha);
            $query = mysqli_query($conn, "INSERT INTO `usuarios`(`nome`, `senha`, `completo`, `perfil`, `email`, `estilo`, `desativar`) VALUES ('$nome','$cript','$completo','$perfil','$email',0,'$desativar')")  or die(mysqli_error($conn));
            echo "<script>alert('o usuário criado com sucesso!')</script>";
            header("Location: login.php");
            exit;
        }
    }

    // Você pode redirecionar ou realizar outras ações aqui
?>