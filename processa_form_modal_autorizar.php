<?php
session_start();
//perfil de acesso
$permissao = $_SESSION[ 'perfil' ];
//variaveis
$nome = $_SESSION[ 'nome' ];
$nivel = $_SESSION[ 'nivel' ];

if ( $nome == '' ) {
    header( 'Location: index.php' );
    exit;
}

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

    // Pegando os dados do formulário
    $anome = $_POST[ 'anome' ] ;
    $cpf = $_POST[ 'acpf' ] ;
    $rg_r = $_POST[ 'arg' ] ;
    $uf = $_POST[ 'cmbrg' ] ;
    $motivo = $_POST[ 'amoti' ] ;
    $data_r = $_POST[ 'adata' ] ;
    $resp = $nome;

    // Exemplo de gravação em variáveis ( pode ser gravado em banco de dados ou arquivo, dependendo da necessidade )
   // verificando se as variáveis estão preenchidas
    if ( empty( $rg_r ) || empty( $anome ) || empty( $cpf ) || empty( $data_r) || empty( $uf) || empty( $motivo) ) {
        echo "<script>alert('Alguns campo não foi digitado!')</script>";
    } else {
        // Fazendo pesquisa pelo cpf e data
        require( './conect.php' );
        $query = mysqli_query( $conn, "SELECT * FROM `autorizar` WHERE cpf='$cpf' AND data_a='$data_r'" )  or die( mysqli_error( $conn ) );
       
        if ( mysqli_num_rows( $query ) ) {
            //Se encontrar altere
            $query = mysqli_query( $conn, "UPDATE `autorizar` SET `rg`='$rg_r', `uf`='$uf', `motivo`='$motivo',`responsavel`='$resp' WHERE cpf='$cpf' AND data_a='$data_r' " );
            header( 'Location: autorizar.php' );
        
        } else {
            //senão crie
            $query = mysqli_query( $conn, "INSERT INTO `autorizar`(`cpf`, `rg`, `uf`, `nome`, `motivo`, `data_a`, `responsavel`) VALUES 
            ('$cpf','$rg_r','$uf','$anome','$motivo','$data_r','$resp')" );
            header( 'Location: autorizar.php' );

        }
    }
}
?>