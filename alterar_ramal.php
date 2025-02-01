<?php
$user = "";
$nome = "";
$ramal = "";
$email= "";
$dep = "";
$cargo = "";
$grupo= "";
$sala= "";
$local= "";
$privado="";
$permissao="";
$id=0;
$check =0
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar dados ramal</title>
    <link rel="stylesheet" href="css/ramal_alt.css">
    <script src="js/funcoes.js"></script>
    <script type="module" src="js/funcoes.js"></script>
    <style>
        body {
            zoom: 0.9;
        }

        @media only screen and (max-width: 1366px) {
            body {
                zoom: 0.5;
            }
        }
    </style>
    <?php
            if (isset($_POST['pesq'])) {
                $user = $_POST['pes-combo'];

                if ($user === ""){
                    echo"<script> alert('Selecione o nome que deve ser alterado!') </script>";
                }else{
                require("./conectar.php");
                $query = mysqli_query($conn, "SELECT * FROM ramais WHERE nome='$user'")  or die(mysqli_error($conn));
                
                if (mysqli_num_rows($query)) {
                    while ($array = mysqli_fetch_row($query)) {
                        $nome = $array[4];
                        $ramal = $array[5];
                        $email= $array[6];
                        $dep = $array[3];
                        $cargo = $array[2];
                        $grupo = $array[10];
                        $sala = $array[7];
                        $local= $array[1];
                        $id=$array[0];
                        $private = $array[9];
                        
                    }
                    if($private == 1){ $check ="checked";}
                   //echo"<script> alert('Registro encontrado com nome  {$nome}!') </script>";
                }else{
                    echo"<script> alert('Nenhum registro encontrado com nome  {$nome}!') </script>";
                }
            }
            }
           
          
?>
</head>

<body class='container-fluir'>
<!-- Tela de cadastro-->
<div class="screen_alt">
    <div class="title">CADASTRO DE RAMAIS</div>
    <form action="" method="post">
        <div class="body_alt">
            <p id="right-lab">Privado<input type="checkbox" name="private" id="private" <?php echo $check;?>></p><br>
            ID:<input class="" type="text" name="cid" id="cid" value="<?php echo $id; ?>" readonly>
            Nome:<input class="" type="text" name="nome" id="nome"
                maxlength="30" value="<?php echo strtoupper($nome); ?>" placeholder="Digite o nome">
            Ramal:<input class="" type="number" name="ramal" id="ramal" value="<?php echo $ramal; ?>"
                placeholder="Digite o ramal">
            E-mail:<input class="" type="email" name="email" id="email" value="<?php echo strtoupper($email); ?>"
                placeholder="Digite o e-mail">
            Departamento:<input class="" type="text" name="dep" id="dep" value="<?php echo strtoupper($dep); ?>"
                maxlength="" placeholder="Digite o departamento">
            Cargo:<input class="" type="text" name="cargo" id="cargo" value="<?php echo strtoupper($cargo); ?>"
                maxlength="" placeholder="Digite o cargo">
            Sala:<input class="" type="text" name="sala" id="sala" value="<?php echo $sala; ?>" maxlength=""
                placeholder="Digite a sala">
            local:<input class="" type="text" name="local" id="local" value="<?php echo strtoupper($local);?>" maxlength=""
                placeholder="Digite o local">

            Grupo:<input class="" type="text" name="cmbgrupo" id="cmbgrupo" value="<?php echo strtoupper($grupo);?>" maxlength=""
                placeholder="Digite o grupo">
        </div>
        <div class="buttons">
            <input class="" type="submit" name="novo" id="novo" value="CRIAR">
            <input class="" type="submit" name="alterar" id="alterar" value="ALTERAR">
            <input class="" type="submit" name="pesq" id="pesq" value="LOCALIZAR">
            <select name="pes-combo" id="pes-combo">
                <option value="">NOMES DOS FUNCIONARIOS PUBLICOS E TERCEIRIZADOS </option>
                <?php
                require "./conectar.php";
                $query = mysqli_query($conn, "SELECT DISTINCT * from ramais where 1 order by nome asc");
                if (mysqli_num_rows($query)) {
                    while ($array = mysqli_fetch_row($query)) {
                        $ramal = $array[4];
                        $id = $array[0];
                        echo "<option>{$ramal}</option>";
                    }
                }
               if (isset($_POST['alterar'])) {
                
             require("./conectar.php");
             $_POST['private'] = ( isset($_POST['private']) ) ? true : 0;
             $private = $_POST['private'];
             $id = $_POST['cid'];
             $nome = $_POST['nome'];
             $ramal = $_POST['ramal'];
             $email = $_POST['email'];
             $dep = $_POST['dep'];
             $cargo = $_POST['cargo'];
             $sala = $_POST['sala'];
             $local = $_POST['local'];
             $grupo = $_POST['cmbgrupo'];
             $data_dia = date("Y-m-d H:i:s");
            

                $nome = strtoupper($nome);
                $email = strtoupper($email);
                $dep = strtoupper( $dep);
                $cargo = strtoupper($cargo);
                $local = strtoupper($local);
                $grupo = strtoupper($grupo);

             $query = mysqli_query($conn, "SELECT * FROM ramais WHERE id_infor='$id'") or
             die(mysqli_error($conn));
             if (mysqli_num_rows($query)) {
             $query = mysqli_query($conn, "UPDATE `ramais` SET
             `LOC`='$local',`CARGO`='$cargo',`DEP`='$dep',`NOME`='$nome',`RAMAL`='$ramal',`EMAIL`='$email',
             `SALA`='$sala',`ATUALIZADO`='$data_dia',`PRIVADO`='$private',`GRUPO`='$grupo' WHERE id_infor='$id'") or
             die(mysqli_error($conn));
             echo "<script>
                 alert('o registro foi alterado com sucesso!');
             </script>";
             } else {
             echo "<script>
                 alert('o registro não foi alterado com sucesso favor verificar! $id');
             </script>";
             }
             }

             if (isset($_POST['novo'])) {
                $nome = $_POST['nome'];
                $ramal = $_POST['ramal'];
                $email = $_POST['email'];
                $dep = $_POST['dep'];
                $cargo = $_POST['cargo'];
                $sala = $_POST['sala'];
                $local = $_POST['local'];
                $grupo = $_POST['cmbgrupo'];
                $data_dia = date("Y-m-d H:i:s");
                $_POST['private'] = ( isset($_POST['private']) ) ? true : null;
                $private = $_POST['private'];

                $nome = strtoupper($nome);
                $email = strtoupper($email);
                $dep = strtoupper( $dep);
                $cargo = strtoupper($cargo);
                $local = strtoupper($local);
                $grupo = strtoupper($grupo);

                //pegando o id da categoria
                require("./conectar.php");
                $data_dia = date("Y-m-d H:i:s"); 
                require("./conectar.php");
                $query = mysqli_query($conn, "SELECT * FROM `ramais` WHERE nome='$nome'") or die(mysqli_error($conn));
                if (mysqli_num_rows($query)) {
                    echo "<script>alert('Este usuário já existe!')</script>";
                    
                } else {
                    if(empty($private)){$private = 0;}
                    $query = mysqli_query($conn, "INSERT INTO `ramais`(`LOC`, `CARGO`, `DEP`, `NOME`, `RAMAL`,
                     `EMAIL`, `SALA`, `ATUALIZADO`, `PRIVADO`, `GRUPO`) VALUES
                    ('$local','$cargo','$dep','$nome','$ramal','$email','$sala','$data_dia','$private','$grupo')") or die(mysqli_error($conn));
                    echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
                }
        
                    }
                ?>
                </select>
            </div>

        </form>

        <button class="" onclick="carregarURL()">RETORNAR A RAMAIS</button>
    </div>

</body>

</html>