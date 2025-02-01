<?php
session_start();
//conexão a classes
require './class/class.visitante.php';
$db = new visitante;

//*Tabela portaria*//
$visitante = '';
$rg = '';
$uf = '';
$tipo = '';
$matricula = '';
$dtcad = '';
$vigilante = '';
$restrigir = '';
$busca = '';
$imagem = '';
$figura = '';
//*tabela visita*//
$destino = '';
$placa = '';
$modelo = '';
$empresa = '';
$portaria = '';
$datavisita = '';
$vigilante_log = '';
$descricao = '';
$cor = '#FFFFFF';
$matriculav = 0;
$private = '';
$permissao = '';
$datc = '';
$id = 0;
$check = "";
$fotoliberar = '';
$bloqueio = '';
$liberar ='liberar';
$cadb = '0';
$solicitante = '';
$telefone ='';
$motivo = '';
$rg_r='';
$butaoS = '';
$alt_p = "disabled";
?>

<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>VISITANTE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='css/visita.css'>
    <link rel='stylesheet' href='css/style_Cam.css'>
    <script src='js/funcoes.js'></script>
    <script type='module' src='js/funcoes.js'></script>
    <script type='module' src='js/cam.js'></script>

    <style>
    /*
@media only screen and ( max-width: 1366px ) {
    body {
        zoom: 0.5;
    }
}
*/
    </style>
    <style>
    body {
        background-image: url('img/visitante.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    </style>
    <script>
    window.addEventListener("beforeunload", function(event) {
        $.ajax({
            async: false,
            url: 'visitante.php',
            data: {
                dados: "teste"
            },
            method: "POST"
        });
        return true;
    });
    </script>
    <?php
if ( isset( $_POST[ 'capture' ] ) ) {
    $rg = $_POST[ 'rg' ];
    $_SESSION[ 'arquivo' ] = $rg .'.png';
    $figura =  $_SESSION[ 'arquivo' ];
}

$nome = $_SESSION[ 'nome' ];
$vigilante_log = $_SESSION[ 'nome' ];
$matricula = $_SESSION[ 'nome' ];
$permissao = $_SESSION[ 'perfil' ];
if ( $nome == '' ) {
    header( 'Location: index.php' );
    exit;
}
$fotoliberar = 'display:none';
$dtcad  = date( 'd/m/Y H:i:s' );
$datavisita = date( 'd/m/Y H:i:s' );
?>

</head>

<body class='container-fluir' onload=''>
    <div class="quadro">
        <?php
if ( isset( $_POST[ 'pesq' ] ) ) {
    $busca = $_POST[ 'pes-combo' ];

    if ( $busca === '' ) {
        echo"<script> alert('Digite o RG!!') </script>";
        header("Refresh: 5");
    } else {
        
        require( './conect.php' );
        //$query = mysqli_query( $conn, "SELECT * FROM portaria INNER JOIN visitas ON portaria.id = visitas.id where portaria.rg='$user ' " ) or die( mysqli_error( $conn ) );
        $query = mysqli_query( $conn, "SELECT * FROM portaria where rg='$busca' " ) or die( mysqli_error( $conn ) );

        if ( mysqli_num_rows( $query ) ) {
            while ( $array = mysqli_fetch_row( $query ) ) {
                $id = $array[ 0 ];
                $rg = $array[ 1 ];
                $_SESSION[ 'arquivo' ] = $rg .'.png';
                $imagem = $array[ 1 ];
                $uf = $array[ 2 ];
                $visitante = $array[ 3 ];
                $tipo = $array[ 4 ];
                $matricula = $array[ 5 ];
                $dtcad = $array[ 6 ];
                $restrigir = $array[ 7 ];
            }
                $fotoliberar = 'display:flex;';
        
            if ( $restrigir == 1 ) {
                $liberar ='bloquear'; 
                $bloqueio = 'btn btn-danger';
                $query = mysqli_query($conn, "SELECT * FROM `restrigir` WHERE rg='$rg'")  or die(mysqli_error($conn));
                if (mysqli_num_rows($query)) {
                    while ($array = mysqli_fetch_row($query)) 
                    { 
                        $solicitante = $array[1];
                        $telefone = $array[2];
                        $motivo = $array[4];
                    }
                } 
            }else{
                $butaoS = '';
                $liberar ='liberar';
                $bloqueio = 'btn btn-success';
            }
            $datc = 'readonly';
            $alt_p= '';
        } else {
            $datc = 'disabled';
            $alt_p ='disabled';
            echo"<script> alert('Nenhum registro encontrado!!  {$visitante }!') </script>";
            header("Refresh: 5");
        }
    }
}
if ( isset( $_POST[ 'fotoarq' ] ) ) {header("Refresh: 5");}
?>
        <!-- Tela de cadastro-->
        <div class='screen_alt'>
            <div class=' alert alert-light menu01 centro_title border_f'>
                <div class=''><img class='border_foto' id='foto'
                        src="<?php if(empty($imagem)){ echo 'uploads/usuario.png'; }else{echo 'uploads/' . $imagem.'.png';}?>"
                        alt='FOTO NÃO REGISTRADA'>
                    <label for="" class='title'>CADASTRO DE VISITAS</label>
                </div>
                <div class='<?php echo $bloqueio?> <?php echo $liberar; ?>' id='acesso'>RESTRIGIR ACESSO
                    <br><?php echo "Solicitante:{$solicitante}" ; ?>
                    <br><?php echo "Contato:{$telefone}" ; ?>
                    <br><?php echo "Motivo:{$motivo}"; ?>
                </div>
            </div>
            <!--  -->
            <form action="" method="POST">
                <div class='body_alt'>
                    <fieldset id="borda" class=''>
                        <legend id="title_leg" class=''>Dados Principais</legend>
                        <div class='menu01'>
                            <label for=''>NOME:</label><input class='' type='text' name='nome' id='nome' maxlength='30'
                                value="<?php echo strtoupper($visitante); ?>" size="45" autofocus>
                            <label for=''>RG:</label><input class='' type='number' name='rg' id='rg'
                                value="<?php echo strtoupper($rg); ?>" size="10" <?php echo $datc; ?>>
                            <label for='tuf'>UF:</label>
                            <select id='tuf' name='tuf' class='cuf'>
                                <option><?php echo strtoupper( $uf );?></option>
                                <option>AC</option>
                                <option>AL</option>
                                <option>AP</option>
                                <option>AM</option>
                                <option>BA</option>
                                <option>CE</option>
                                <option>DF</option>
                                <option>ES</option>
                                <option>GO</option>
                                <option>MA</option>
                                <option>MT</option>
                                <option>MS</option>
                                <option>MG</option>
                                <option>PA</option>
                                <option>PB</option>
                                <option>PR</option>
                                <option>PI</option>
                                <option>RJ</option>
                                <option>RN</option>
                                <option>RS</option>
                                <option>RO</option>
                                <option>RR</option>
                                <option>SC</option>
                                <option>SP</option>
                                <option>SE</option>
                                <option>TO</option>
                            </select>
                            <label for=''>TIPO:</label>
                            <select id='tipo' name='tipo' class='cuf'>
                                <option><?php echo strtoupper( $tipo );?></option>
                                <option>VISITANTE</option>
                                <option>FUNCIONARIO</option>
                            </select>
                            <label for=''>DATA:</label><input class='' type='text' name='dat' id='dat'
                                value="<?php echo strtoupper($dtcad); ?>" maxlength='' readonly size='18'>
                            <label for=''>RESP_CAD:</label><input class='' type='text' name='matr' id='matr'
                                value="<?php  echo $matricula; ?>" maxlength='' disabled>
                                
                                
    
                        </div>
                    </fieldset>

                    <fieldset id="borda" class=''>
                        <legend id="title_leg">Dados da visita</legend>
                        <label for=''>DESTINO:</label>
                        <!--<input class='' type='text' name='dest' id='dest'
                            value="" maxlength='' size='25' reader>-->
                        <select name="dest" id="dest" class="cuf">
                            <?php
                require "./conectar.php";
                $query = mysqli_query($conn, "SELECT DISTINCT * from ramal where 1 order by nome asc");
                if (mysqli_num_rows($query)) {
                    while ($array = mysqli_fetch_row($query)) {
                        $ramal = $array[1];
                        echo "<option>{$ramal}</option>";
                    }
                }
                            ?>< </select>

                                <label for=''>EMPRESA:</label><input class='' type='text' name='empr' id='empr'
                                    value="<?php echo strtoupper($empresa);?>" maxlength=''>
                                <label for='' id='visita'>DETALHE DA VISITA:</label><input class='' type='text'
                                    name='desta' id='desta' value="<?php echo strtoupper( $descricao );?>"
                                    placeholder='' maxlength='40' size='40'>
                                <label for=''>DT_VISITA:</label><input class='' type='text' name='datav' id='datav'
                                    value="<?php echo $datavisita;?>" maxlength='' readonly><br><br>
                                <div class='menu01 ' id='spaco'>
                                    <label for=''>AUTOMOVEL:</label><input class='' type='text' name='modelo'
                                        id='modelo' value="<?php echo $modelo; ?>" maxlength=''>
                                    <label for=''>PLACA:</label><input class='' type='text' name='placa' id='placa'
                                        value="<?php echo $placa; ?>" maxlength=''>

                                    <label for=''>COR:</label><select style='width: 150px;' id='cor' name='cor'
                                        class='cuf'>
                                        <option></option>
                                        <option>BRANCA</option>
                                        <option>CINZA</option>
                                        <option>PRETA</option>
                                        <option>PRATA</option>
                                        <option>AZUL</option>
                                        <option>AMARELO</option>
                                        <option>VERMELHO</option>
                                        <option>VERDE</option>
                                        <option>ROSA</option>
                                        <option>LARANJA</option>
                                        <option>ROXO</option>
                                        <option>VIOLETA</option>
                                        <option>OUTRAS</option>
                                    </select>
                                    <label for=''>ENTRADA:</label> <select id='ent' name='ent' class='cuf'>
                                        <option></option>
                                        <option>ALPHA PRIMERO</option>
                                        <option>ALPHA SEGUNDO</option>
                                    </select>
                                    <label for=''>VIGILANTE:</label><input class='' type='text' name='vigilante'
                                        id='vigilante' value="<?php echo $vigilante_log; ?>" maxlength='' disabled>
                    </fieldset>
                </div>
                <div class='buttons'>
                    <button class='balanco btn btn-outline-dark' type='submit' name='novo' id='novo'
                        onclick='limparConteudo()'>NOVO</button>
                    <button class='balanco btn btn-outline-dark' type='submit' name='salvar' id='salvar'>SALVAR
                         VISITA</button>
                        <button class='balanco btn btn-outline-dark' type='submit' name='alt' id='alt' <?php echo $alt_p; ?>>ALTERAR PRINCIPAIS</button>
                    <button class='balanco btn btn-outline-dark' type='submit' name='pesq' id='pesq'
                        onclick="desativar()">LOCALIZAR RG</button>
                    <input class='' type='text' name='pes-combo' id='pes-combo' maxlength=''>
                    <?php
if ( isset( $_POST[ 'salvar' ] ) ) {
//tab dados principais
    $rg = $_POST[ 'rg' ] ;
    $uf = $_POST[ 'tuf' ] ;
    $visitante = $_POST[ 'nome' ];
    $tipo = $_POST[ 'tipo' ] ;
    $dtcad = $_POST[ 'dat' ] ;
    //dados visitas 
    $destino = $_POST[ 'dest' ] ;
    $placa  = $_POST[ 'placa' ] ;
    $modelo = $_POST[ 'modelo' ] ;
    $empresa = $_POST[ 'empr' ] ;
    $descricao = $_POST[ 'desta' ] ;
    $cor = $_POST[ 'cor' ];
    $portaria = $_POST[ 'ent' ];
    $datavisita = $_POST[ 'datav' ];
    $filtro = date('Y-m-d');
//verificando variaveis do automovel.
        if(empty($placa)){ $placa ='sem informação';}
        if(empty($modelo)){$modelo = 'sem informação';}
        if(empty($cor)){$cor ='sem informação';}
    //converter em letras maiusculas.
    $destino = strtoupper( $destino);
    $placa = strtoupper(  $placa);
    $visitante = strtoupper( $visitante );
    $tipo = strtoupper( $tipo );
    $descricao = strtoupper( $descricao );
    $modelo = strtoupper( $modelo );
    $empresa = strtoupper( $empresa );
    $portaria = strtoupper( $portaria );
    $vigilante_log = strtoupper( $vigilante_log );
    $cor= strtoupper( $cor );
    $resposta = $db->add_visita($rg,$uf,$visitante,$tipo,$matricula,$dtcad,$destino, $placa, $modelo, $empresa,$descricao,$cor,$portaria, $datavisita,$vigilante_log,$filtro);
}

if ( isset( $_POST[ 'alt' ] ) ) {
   
    //tab dados principais
    $rg = $_POST[ 'rg' ] ;
    $uf = $_POST[ 'tuf' ] ;
    $visitante = $_POST[ 'nome' ];
    $tipo = $_POST[ 'tipo' ] ;
    
    //converter em letras maiusculas.
    $visitante = strtoupper( $visitante );
    $tipo = strtoupper( $tipo );
   
    if ( empty( $rg ) || empty( $visitante ) || empty( $uf ) || empty ( $tipo ) ) {
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
    }
    
    }
?>
<button class='btn btn-outline-dark balanco' type='button' onclick='carregarURL()'>VOLTAR</button>
            </form>
            
            
        </div>

        <div class='menu01 container-fluir' id='spaco' style='<?php echo $fotoliberar; ?>'>
            <a class=' bespaco' href='#rodape' id='bespaco'><button class='' type='button' data-bs-toggle='collapse'
                    data-bs-target='#collapseExample' aria-expanded='false'
                    aria-controls='collapseExample'>CAMERA</button></a><br>
        </div>
        <div class='collapse menu01' id='collapseExample'>
            <div class='' id='spaco_c'>
                <p class='alert alert-secondary'>Câmera</p>
                <video id='video' width='320' height='240' autoplay></video>
            </div>
            <div class='' id='spaco_c'>
                <!-- Canvas para mostrar a foto tirada -->
                <p class='alert alert-secondary'>Foto</p>
                <canvas id='canvas' width='320' height='240'></canvas>

                <a class='espaco' id='bespaco' href='#rodape'> <button class='' type='submit' id='capture'
                        name='capture' value=''>TIRAR FOTO</button></a>
            </div>
            <form action="" method="post" class='centro'>
                <input type="submit" name='fotoarq' id='fotoarq' value="Atualizar">
                <p class='title'><?php  echo 'Nome Arquivo:' . $imagem;?></p>
        </div>
    </div>
    </div>
    <p id='rodape'></p>
    </div>

</body>

</html>