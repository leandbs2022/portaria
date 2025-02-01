<?php
// Carregar o Composer
require './vendor/autoload.php';
require("./conect.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$date_ma = date( 'Y-m-' );
$dt01 = "{$date_ma}01";
$dtcad  = date( 'Y-m-d' );

$query = mysqli_query( $conn, "SELECT * FROM portaria INNER JOIN visitas ON portaria.rg = visitas.rg where visitas.filtro between '$dt01' AND '$dtcad'") 
or die( mysqli_error( $conn ) );
//$query = mysqli_query($conn, "SELECT * FROM visitas WHERE rg='1443106'")  or die(mysqli_error($conn));
// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='css/relatorio.css'";
$dados .= "<title>Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1 class='title01'>Lista de visitas por periodo mensal</h1>"; 
$dados.= "<hr>";
if (mysqli_num_rows($query)) {
while ($array = mysqli_fetch_row($query)) {
    $dados.= "NOME: $array[3] ";
    $dados.= "DESTINO: $array[9] ";
    $dados.= "EMPRESA: $array[12] ";
    $dados.= "DATA: $array[18] ";
    $dados.= "Motivo: $array[16] ";
    $dados.= "<hr>";
    }
}else{
    $dados.= "Nenhum registro encontrado!!!!!!!!!!!!";
}
$dados .= "<img src=''><br>";
$dados .= "Data do relatório de $dt01 a $dtcad";
$dados .= "</body>";
// Referenciar o namespace Dompdf


// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);
// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'landscape');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream('mensal.pdf',array('Attachment'=>0));
