<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ramais</title>
    <link rel="stylesheet" href="css/ramal.css">
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
    <h1 class='alert alert-light center'>RAMAIS IMPORTANTES</h1>
    <?php

require("./conect.php");
$query = mysqli_query($conn, "SELECT * FROM ramal WHERE 1")  or die(mysqli_error($conn));;
if (mysqli_num_rows($query)) {
    $estilos[0] = "background-color:#E6E6E6;font-size:18px;color:black;font-style:bolder;font-family: Arial, Helvetica, sans-serif;text-align:center; 
    padding:5px; margin:5px; border: 1px solid #0a0a0a; width: auto; ";
    echo "<table style=\"width:100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
    <td style=\"$estilos[0]\">NOME</td>
    <td style=\"$estilos[0]\">RAMAL</td>
    </tr>";
    $color ="";
    while ($array = mysqli_fetch_row($query)) {
                $count = $count + 1;
                if ($count % 2 == 0) {
                    $color = "#E6E6E6";
                } else {
                    $color = "white";
                }
                $estilos[1] = "background-color:{$color};font-size:16px;color:black;font-weight: bold;padding: 10px;font-family: Times New Roman, Times, serif;
                text-align: center;  width: auto;  border: 1px solid #0a0a0a;";
        echo "<tr>
        <td style=\"$estilos[1]\">$array[1]</td>
        <td style=\"$estilos[1]\">$array[2]</td>
        </tr>";
    }
}


?>
<a href="portaria.php" class='btn btn-outline-dark'>Voltar a tela principal</a>
    </div>
</body>
</html>