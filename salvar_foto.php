<?php
session_start();
$arquivo =  $_SESSION["arquivo"];
// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados JSON enviados
    $data = json_decode(file_get_contents('php://input'));

    // Verifica se o campo 'image' existe nos dados recebidos
    if (isset($data->image)) {
        $image = $data->image;

        // Remove a parte 'data:image/png;base64,' da string
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        // Decodifica a imagem de base64 para binário
        $imageData = base64_decode($image);

        // Define o nome do arquivo com base na data e hora atuais
        $filePath = 'uploads/' . $arquivo;

        // Salva a imagem no servidor no diretório 'uploads'
        if (file_put_contents($filePath, $imageData)) {
            echo "<script> alert('Foto salva com sucesso:. $filePath' </script> ";
        } else {
            echo "Erro ao salvar a foto.";
        }
    } else {
        echo "Imagem não recebida.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
