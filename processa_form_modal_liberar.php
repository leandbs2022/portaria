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
    $rg_r = $_POST[ 'crgl' ] ;
    $motivo = $_POST[ 'lmoti' ] ;
    $data_r = ( date( 'd-m-Y H:i:s' ) );
    $restrigir = 0;

    // Exemplo de gravação em variáveis ( pode ser gravado em banco de dados ou arquivo, dependendo da necessidade )

    if ( empty( $rg_r ) || empty( $motivo ) ) {
        echo "<script>alert('RG ou motivo não foi digitado!')</script>";
    } else {
        require( './conect.php' );
        $query = mysqli_query( $conn, "SELECT * FROM `restrigir` WHERE rg='$rg_r'" )  or die( mysqli_error( $conn ) );
        if ( mysqli_num_rows( $query ) ) {
            
            while ( $array = mysqli_fetch_row( $query ) ) {
                $id = $array[ 0 ];
            }

            $query = mysqli_query( $conn, "UPDATE `restrigir` SET `motivo`='$motivo',`data`='$data_r',`autorizado`='$restrigir' WHERE rg='$id'" );

            $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg_r'" )  or die( mysqli_error( $conn ) );
            if ( mysqli_num_rows( $query ) ) {
               $restrigir = 0;
                $query = mysqli_query( $conn, "UPDATE `portaria` SET `restrigir`='$restrigir' WHERE rg='$rg_r'" );
            }
            echo "<script>alert('Esse registro foi alterado!')</script>"; 
            header( 'Location: tela.php' );
            exit;
        } else {
            echo "<button class='btn btn-secondary' type='button'>RG NÃO EXISTE VOLTAR PARA TELA DE CONFIGURAÇÃO</button>";
        }
    }
}
?>