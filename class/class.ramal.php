<?php
class ramal //classe - Funcões

{
    function add_ramal($nome, $ramal, $email, $dep, $cargo, $grupo,$sala,$local,$private,$grupo)
    {
        $data_dia = date("Y-m-d H:i:s"); 
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM `ramal` WHERE nome='$nome'");
        if (mysqli_num_rows($query)) {
            echo "<script>alert('Este usuário já existe!')</script>";
        } else {
            $query = mysqli_query($conn, "INSERT INTO `ramal`(`LOC`, `CARGO`, `DEP`, `NOME`, `RAMAL`, `EMAIL`, `SALA`, `ATUALIZADO`, `PRIVADO`, `GRUPO`) VALUES
            ('$local','$cargo','$dep','$nome','$ramal','$email','$sala','$data_dia','$private','$grupo')") or die(mysqli_error($conn));
            echo "<script>alert('o registro criado com sucesso!A página será atualizada agora!');</script>";
        }
    }

    function alt_ramal($nome, $ramal, $email, $dep, $cargo, $grupo, $sala, $local, $private,$grupo)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT DISTINCT * FROM ramal WHERE nome='$nome'")  or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
            if (mysqli_num_rows($query)) {
                while ($array = mysqli_fetch_row($query)) { $id = $array[0];}
            $query = mysqli_query($conn, "UPDATE `ramal` SET `LOC`='$local',`CARGO`='$cargo',`DEP`='$dep',`NOME`='$nome',`RAMAL`='$ramal',`EMAIL`='$email',
            `SALA`='$sala',`ATUALIZADO`='$data_dia',`PRIVADO`='$private',`GRUPO`='$grupo' WHERE id_infor='$id'")  or die(mysqli_error($conn));
            echo "<script>alert('o registro foi alterado com sucesso!');
        </script>";
        } else {
            echo "<script>alert('o registro não foi alterado com sucesso favor verificar!');
        </script>";
        }
    }

    function pes_ramal($user)
    {
        require("./conect.php");
        $query = mysqli_query($conn, "SELECT * FROM ramal WHERE nome='$user'")  or die(mysqli_error($conn));
        
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
            }
            
           //echo"<script> alert('Registro encontrado com nome  {$nome}!') </script>";
        }else{
            echo"<script> alert('Nenhum registro encontrado com nome  {$nome}!') </script>";
        }
    }
}
}
?>