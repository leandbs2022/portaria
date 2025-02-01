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
    $solicitante = $_POST[ 'csoli' ] ;
    $rg_r = $_POST[ 'crg' ] ;
    $motivo = $_POST[ 'moti' ] ;
    $telefone = $_POST[ 'ctel' ] ;
    $data_r = ( date( 'd-m-Y H:i:s' ) );
    
    $restrigir = 1;

    // Exemplo de gravação em variáveis ( pode ser gravado em banco de dados ou arquivo, dependendo da necessidade )

    if ( empty( $rg_r ) || empty( $solicitante ) || empty( $motivo ) ) {
        echo "<script>alert('RG, Solicitante ou motivo não foi digitado!')</script>";
    } else {
        require( './conect.php' );
        $query = mysqli_query( $conn, "SELECT * FROM `restrigir` WHERE rg='$rg_r'" )  or die( mysqli_error( $conn ) );
        if ( mysqli_num_rows( $query ) ) {
            while ( $array = mysqli_fetch_row( $query ) ) {
                $id = $array[ 0 ];
            }
            $query = mysqli_query( $conn, "UPDATE `restrigir` SET `solicitante`='$solicitante',`telefone`=' $telefone',`rg`='$rg_r',`motivo`='$motivo',`data`='$data_r',
            `autorizado`='$restrigir' WHERE id='$id'" );
            $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg_r'" )  or die( mysqli_error( $conn ) );
            if ( mysqli_num_rows( $query ) ) {
               $restrigir = 1;
                $query = mysqli_query( $conn, "UPDATE `portaria` SET `restrigir`='$restrigir' WHERE rg='$rg_r'" );
            }
            echo "<script>alert('Esse registro já existe só será alterado!')</script>"; 
            header( 'Location: tela.php' );
            exit;
        } else {
            $restrigir = 1;
            $query = mysqli_query( $conn, "INSERT INTO `restrigir`(`solicitante`, `telefone`, `rg`, `motivo`, `data`, `autorizado`) VALUES 
            ('$solicitante','$telefone','$rg_r','$motivo','$data_r','$restrigir')" );
            echo "<script>alert('Dados enviado com sucesso!')</script>";
            header( 'Location: tela.php' );
            exit;
        }
    }
}
?>