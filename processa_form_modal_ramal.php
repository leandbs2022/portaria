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
    $nome = $_POST[ 'nome' ] ;
    $ramal = $_POST[ 'ramal' ] ;

    // Exemplo de gravação em variáveis ( pode ser gravado em banco de dados ou arquivo, dependendo da necessidade )

    if ( empty( $nome ) ) {
        echo "<script>alert('Não foi digitado nenhum dados!')</script>";
    } else {
        require( './conect.php' );
        $query = mysqli_query( $conn, "SELECT * FROM `ramal` WHERE nome='$nome'" )  or die( mysqli_error( $conn ) );

        if ( mysqli_num_rows( $query ) ) {
            while ( $array = mysqli_fetch_row( $query ) ) {
                $id = $array[ 0 ];
            }
            $query = mysqli_query( $conn, "UPDATE `ramal` SET `nome`='$nome',`ramal`=' $ramal' WHERE id='$id'" );
            echo "<script>alert('Esse registro já existe só será alterado!')</script>"; 
            header( 'Location: ramal.php' );
            exit;

        } else {
            $restrigir = 1;
            $query = mysqli_query( $conn, "INSERT INTO  `ramal`(`nome`, `ramal`) VALUES 
            ('$nome','$ramal')" );
            echo "<script>alert('Dados enviado com sucesso!')</script>";
            header( 'Location: ramal.php' );
            exit;
        }
    }
}
?>