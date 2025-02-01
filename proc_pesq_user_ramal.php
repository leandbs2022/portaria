<?php
session_start();
$permissao = $_SESSION["perfil"];
$nome = $_SESSION["nome"];

header("Content-Type: text/html; charset=UTF-8",true);

$servername = "localhost";
$username = "lbscode";
$password = "";
$dbname = "lbscode";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

//Receber a requisão da pesquisa
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
	0 =>'ID_INFOR',
	1 => 'NOME',
	2 => 'RAMAL',
	3 => 'EMAIL',
	4 => 'GRUPO',
	5 => 'DEP',
	6 => 'CARGO'
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT * FROM ramais";
$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados

	$result_ramais = "SELECT * FROM ramais WHERE 1=1 and privado ='0'";

if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_ramais.=" AND (NOME LIKE '".$requestData['search']['value']."%' ";
	$result_ramais.=" OR CARGO LIKE '".$requestData['search']['value']."%' ";
	$result_ramais.=" OR GRUPO LIKE '".$requestData['search']['value']."%' ";
	$result_ramais.=" OR DEP LIKE '".$requestData['search']['value']."%' )";
	
}

$resultado_ramais=mysqli_query($conn, $result_ramais);
$totalFiltered = mysqli_num_rows($resultado_ramais);
//Ordenar o resultado
$result_ramais.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_ramais=mysqli_query($conn, $result_ramais);

// Ler e criar o array de dados
$dados = array();
while( $row_ramais =mysqli_fetch_array($resultado_ramais) ) {
	$dado = array();
	$dado[] = $row_ramais["ID_INFOR"];
	$dado[] = $row_ramais["NOME"];
	$dado[] = $row_ramais["RAMAL"];
	$dado[] = $row_ramais["EMAIL"];
	$dado[] = $row_ramais["GRUPO"];
	$dado[] = $row_ramais["DEP"];
	$dado[] = $row_ramais["CARGO"];
	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript

$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela
);

echo json_encode($json_data);  //enviar dados como formato json