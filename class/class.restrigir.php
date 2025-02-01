<?php
class restrigir //classe - Funcões
{
//////////////////////////////////////////////Equipamento//////////////////////////////////////////////////

function add_equip($solicitante,$rg_r,$motivo,$restrigir,$data_r){

    //( isset($_POST['private']) ) ? true : 0;
    if(empty($rg_r) || empty($solicitante) || empty($motivo)){
        echo "<script>alert('(Modelo) ou (Tipo) não foi digitado!')</script>";
    }else{
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `equipamento` WHERE modelo='$modelo'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Esse registro já existe só será alterado!')</script>";
            while ($array = mysqli_fetch_row($query)) { $id_mod = $array[0];}
            $query = mysqli_query($conn,"UPDATE `equipamento` SET `modelo`='$modelo',`marca`='$marca',`processador`='$processador',`memoria`='$memoria',`disco`='$disco',`chipset`='$chipset',
            `pgrafico`='$pgrafico',`link_sup`='$link_sup',`fonte`='$fonte',`tipo`='$tipo' WHERE id_mod='$id_mod'");
        }else{
            echo "<script>alert('Dados enviado com sucesso!')</script>";
            $query = mysqli_query($conn, "INSERT INTO `equipamento`(`modelo`, `marca`, `processador`, `memoria`, `disco`, `chipset`, `pgrafico`, `link_sup`, `fonte`, `tipo`) VALUES
             ('$modelo','$marca','$processador','$memoria','$disco','$chipset','$pgrafico','$link_sup','$fonte','$tipo')");
             return $query;
        }
    } 
    }
    function alt_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function del_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function loc_equip($localizar){
     
        require "./conect.php";
        $query = mysqli_query($conn, "SELECT DISTINCT * from equipamento where modelo='$localizar'");
        if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
            $_SESSION["modelo"] = $array[1];
            $_SESSION["marca"] = $array[2];
            $_SESSION["processador"] = $array[3];
            $_SESSION["memoria"] = $array[4];
            $_SESSION["disco"] = $array[5];
            $_SESSION['chipset'] = $array[6];
            $_SESSION["pgrafico"] = $array[7];
            $_SESSION["link_sup"] = $array[8];
            $_SESSION['fonte'] = $array[9];
            $_SESSION['tipo'] = $array[10];
           
        }
        }else{
            
        }
    }
    function rel_equip($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
    
    }
    function verficador_coord($coordenador){
    
    }
//////////////////////////////////////////////Laudos//////////////////////////////////////////////////
function add_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tipo,$tecnico,$data){
if(empty($chamado) || empty($serial) ){
    echo "<script>alert('Número e Serial não foi digitado!')</script>";
}else{
    require("./conect.php");
    $query = mysqli_query($conn, "SELECT * FROM `laudos_pc` WHERE chamado='$chamado' and nserial='$serial' ")  or die(mysqli_error($conn));
    if (mysqli_num_rows($query)) {
        echo "<script>alert('Esse registro já existe!')</script>";
    }else{
        echo "<script>alert('dados enviados!')</script>";
        $query = mysqli_query($conn, "INSERT INTO `laudos_pc`(`patrimonio`, `nserial`, `modelo`, `chamado`, `cliente`, `descr`, `tipo`, `tecnico`, `data`) VALUES
         ('$patrimonio','$serial','$modelo','$chamado','$cliente','$situacao','$tipo','$tecnico','$data')");
    }
}

}

function add_laudos2($modelo,$dados2){
    if(empty($modelo) || empty($dados2) ){
        echo "<script>alert('$modelo')</script>";
    }else{
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `laudos_dados_equi` WHERE modelo='$modelo'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Esse registro já existe!')</script>";
        }else{
            $query = mysqli_query($conn, "INSERT INTO `laudos_dados_equi`(`modelo`, `texto`) VALUES ('$modelo','$dados2')");
             echo "<script>alert('dados enviados!')</script>";
        }
    }
}
function alt_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}
function del_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}
function loc_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){
   
}
function rel_laudos($patrimonio,$serial,$modelo,$chamado,$cliente,$situacao,$tecnico,$data){

}

function gerar_laudo_pc($laudo)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM laudos_pc WHERE id_lau='$laudo'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            while ($array = mysqli_fetch_row($query)) {
                $_SESSION["id_lau"] = $array[0];
                $_SESSION["patrimonio"] = $array[1];
                $_SESSION["serial"] = $array[2];
                $_SESSION["modelo"] = $array[3];
                $_SESSION["chamado"] = $array[4];
                $_SESSION['cliente'] = $array[5];
                $_SESSION["descr"] = $array[6];
                $_SESSION["tipo"] = $array[7];
                $_SESSION['tecnico'] = $array[8];
                $_SESSION["data"] = $array[9];
            }
                echo "<p><button type='button' name='tlaudo' class='btn btn-success'>Resultado gerado...</button></p>";
        } else {
            if ($ativo == 1) echo "<script>alert('Niguém encontrado com esse codigo!')</script>";
        }
    }
}