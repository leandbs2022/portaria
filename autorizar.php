<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Autorizações</title>
    <link rel="stylesheet" href="css/autorizar.css">
    <style>
    body {
        background-image: url('img/cabine.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    </style>

</head>

<body>
    <div class="container-fluir">
        <h1 class='alert alert-light  center'>AUTORIZAÇÕES FERIADOS E FIM DE SEMANA</h1>
        <div>
            <?php

    require("./conect.php");
    $query = mysqli_query($conn, "SELECT * FROM autorizar WHERE 1 ORDER BY data_a desc")  or die(mysqli_error($conn));;
    if (mysqli_num_rows($query)) {
        
        $estilos[0] = "background-color:#E6E6E6;font-size:18px;color:black;font-style:bolder;font-family: Arial, Helvetica, sans-serif;text-align:center;
         padding:5px; margin:5px; border: 1px solid #0a0a0a; width: auto; ";
        echo "<table style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">CPF</td>
        <td style=\"$estilos[0]\">RG</td>
        <td style=\"$estilos[0]\">UF</td>
         <td style=\"$estilos[0]\">NOME</td>
        <td style=\"$estilos[0]\">MOTIVO</td>
        <td style=\"$estilos[0]\">DATA</td>
          <td style=\"$estilos[0]\">LIBERADO POR</td>
            <td style=\"$estilos[0]\">SITUAÇÃO</td>
        </tr>";
        $color ="";
        while ($array = mysqli_fetch_row($query)) {
                    $count = $count + 1;
                    if ($count % 2 == 0) {
                        $color = "#E6E6E6";
                    } else {
                        $color = "white";
                    }
        $futura ="";
        $date_a = date('Y-m-d');
        $date_f = $array[5];

        if($date_a === $date_f){$futura = "Autorização de hoje"; $color = "#00FF40";} else {$futura = "Autorização futuras";$color="#FFFF00";};
        if($date_a > $date_f){$futura = "Autorização antigas"; $color = "#81DAF5";};

            $estilos[1] = "background-color:{$color};font-size:16px;color:black;font-weight: bold;padding: 10px;font-family: Times New Roman, Times, serif;
            text-align: center;  width: auto;  border: 1px solid #0a0a0a;";
            echo "<tr>
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[4]</td>
            <td style=\"$estilos[1]\">$array[5]</td>
            <td style=\"$estilos[1]\">$array[6]</td>
            <td style=\"$estilos[1]\">$futura</td>
            </tr>";

        }
}
?>
            <form action="" method="post">
                <!--<input type="date" id='data' name='data' class='espaco'><input type="submit"
                    class="btn btn-success espaco" id='pesq' name='pesq' value='pesquisar outras datas'>-->
                <a href="portaria.php"><button type="button" class="btn btn-outline-dark">Voltar a tela
                        principal</button></a>
            </form>
        </div>
    </div>
</body>

</html>