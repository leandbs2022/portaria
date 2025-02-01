<?php

class visitante //classe - Funcões
 {
    function add_visita( $rg, $uf, $visitante, $tipo, $matricula, $dtcad, $destino, $placa, $modelo, $empresa, $descricao, $cor, $portaria, $datavisita, $vigilante_log,$filtro )
 {

        if ( empty( $rg ) || empty( $visitante ) || empty( $descricao ) || empty( $destino ) || empty( $empresa ) || empty( $portaria ) ) {
            echo "<script>alert('verificar se ficou algum campo sem digitar!')</script>";
        } else {

            require( './conect.php' );
            $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg'" )  or die( mysqli_error( $conn ) );

            if ( mysqli_num_rows( $query ) ) {

                //inserir visitas
                $query = mysqli_query( $conn, "INSERT INTO `visitas`(`rg`, `destino`, `placa`, `modelo`, `empresa`, `portaria`, `data`, `resp`,`descricao`, `cor`, `filtro`) VALUES 
                ('$rg','$destino', '$placa','$modelo','$empresa','$portaria','$datavisita','$vigilante_log','$descricao', '$cor', '$filtro ')" ) or die( mysqli_error( $conn ) );

                //atualiza dados pessoais
                $query = mysqli_query( $conn, "UPDATE `portaria` SET `uf`='$uf',`nome`='$visitante',`tipo`='$tipo' WHERE rg='$rg'" ) or die( mysqli_error( $conn ) );
                echo "<script>alert('Ação bem sucedida!')</script>";
                return $query;

            } else {

                //inserir dados pessoais
                $query = mysqli_query( $conn, "INSERT INTO `portaria`(`rg`, `uf`, `nome`, `tipo`, `vigilante`, `dt_cad`, `restrigir`) VALUES
                 ('$rg','$uf','$visitante','$tipo','$matricula','$dtcad',0)" )  or die( mysqli_error( $conn ) );

                //inserir visitas
                $query = mysqli_query( $conn, "INSERT INTO `visitas`(`rg`, `destino`, `placa`, `modelo`, `empresa`, `portaria`, `data`, `resp`, `descricao`,
                 `cor, `filtro`) VALUES 
                ('$rg','$destino', '$placa','$modelo','$empresa','$portaria','$datavisita','$vigilante_log','$descricao', '$cor', '$filtro ')" )  or die( mysqli_error( $conn ) );
                echo "<script>alert('Dados enviado com sucesso!')</script>";
                return $query;

            }
            //sair
            exit;

        }
    }

}

function alterar_rg( $rg, $uf, $visitante, $tipo, $matricula, $dtcad, $destino, $placa, $modelo, $empresa, $descricao, $cor, $portaria, $datavisita, $vigilante_log ) {
    //conectando no BD
    require( './conect.php' );
    //fazendo busca de registro
    $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg'" )  or die( mysqli_error( $conn ) );
    //Resultado da busca
    if ( mysqli_num_rows( $query ) ) {
        //caso encontre altere - Localizado o ID do RG
        while ( $array = mysqli_fetch_row( $query ) ) {
            $id = $array[ 0 ];
        }
        //atualiza dados pessoais e visitas
        $query = mysqli_query( $conn, "UPDATE `portaria` SET `rg`='$rg' WHERE id='$id'" ) or die( mysqli_error( $conn ) );
        $query = mysqli_query( $conn, "UPDATE `visitas` SET `rg`='$rg' WHERE rg='$rg'" ) or die( mysqli_error( $conn ) );
        echo "<script>alert('Ação bem sucedida! Alterado histórico.')</script>";
        return $query;
    } else {
        //caso não encontre
        echo "<script>alert('Nenhum registro encontrado com esse RG para ser alterado!!!')</script>";
    }
}

function alterar_p($rg,$uf,$visitante,$tipo ) {

   
    echo "<script>alert('Campo Rg esta vazio faça um busca!')</script>";
    /*if ( empty( $rg ) || empty( $visitante ) || empty( $uf ) || empty ( $tipo ) ) {
        echo "<script>alert('verificar se ficou algum campo sem digitar!')</script>";
    } else {

        require( './conect.php' );
        $query = mysqli_query( $conn, "SELECT * FROM `portaria` WHERE rg='$rg'" )  or die( mysqli_error( $conn ) );

        if ( mysqli_num_rows( $query ) ) {
            //caso encontre altere - Localizado o ID do RG
            while ( $array = mysqli_fetch_row( $query ) ) {
                $id = $array[ 0 ];
            }
            //atualiza dados pessoais
            $query = mysqli_query( $conn, "UPDATE `portaria` SET `uf`='$uf',`nome`='$visitante',`tipo`='$tipo' WHERE id='$id'" ) or die( mysqli_error( $conn ) );
            echo "<script>alert('Ação bem sucedida!')</script>";

        } else {
            echo "<script>alert('Campo Rg esta vazio faça um busca!')</script>";
        }
    }*/
}
function teste(){
    echo "<script>alert('teste')</script>";
}
?>