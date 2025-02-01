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
    
    $rg = $_POST[ 'crgalt' ] ;

    $rg_loc = $_POST[ 'lrgalt' ] ;

    //conectando no BD
    require( './conect.php' );
    //fazendo busca de registro
    
    $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg'" )  or die( mysqli_error( $conn ) );

    if ( mysqli_num_rows( $query ) ) {
        echo "<script>alert('Este RG inserido não pode ser alterado pois já existe em outro cadastro!.')</script>";
        echo"<a href=tela.php> Voltar para tela de informações </a>";

    }else{

    $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg_loc'" )  or die( mysqli_error( $conn ) );
    //Resultado da busca
    if ( mysqli_num_rows( $query ) ) {
        //caso encontre altere - Localizado o ID do RG
        while ( $array = mysqli_fetch_row( $query ) ) {
            $id = $array[ 0 ];
        }
        //atualiza dados pessoais e visitas
        $query = mysqli_query( $conn, "UPDATE `portaria` SET `rg`='$rg' WHERE id='$id'" ) or die( mysqli_error( $conn ) );
        $query = mysqli_query( $conn, "UPDATE `visitas` SET `rg`='$rg' WHERE rg='$rg_loc'" ) or die( mysqli_error( $conn ) );
        echo "<script>alert('Ação bem sucedida! Alterado histórico.')</script>";
        echo"<h2>O RG $rg_loc foi substiuido por $rg </h2>";
        echo"<a href=tela.php> Voltar para tela de informações </a>";
        return $query;
    } else {
        //caso não encontre
        echo "<script>alert('Nenhum registro encontrado com esse RG para ser alterado!!!')</script>";
        echo"<a href=tela.php> Voltar para tela de informações </a>";
        
    }

}


}
?>