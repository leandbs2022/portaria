<?php
session_start();
$permissao = $_SESSION[ 'perfil' ];
$nome = $_SESSION[ 'nome' ];

header( 'Content-Type: text/html; charset=UTF-8', true );

$servername = "localhost";
$username = "lbscode";
$password = "";
$dbname = "lbscode";

$conn = mysqli_connect( $servername, $username, $password, $dbname );
$conn->set_charset( 'utf8' );

//Receber a requisão da pesquisa
$requestData = $_REQUEST;

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array(
    0 => 'rg_portaria',
    1 => 'rg_visitas',
    2 => 'nome_portaria',
    3 => 'destino_visitas',
    4 => 'placa_visitas',
    5 => 'modelo_visitas',
    6 => 'empresa_visitas',
    7 => 'portaria_visitas',
    8 => 'data_visitas',
    9 => 'resp_visitas',
    10 => 'descricao_visitas',
    11=> 'cor_visitas'
    
);
//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT 
		/* tabela portaria*/
	   	portaria.rg AS rg_portaria, 
        portaria.nome AS nome_portaria, 
		/* tabela visitas*/
        visitas.rg AS rg_visitas,
		visitas.destino AS destino_visitas,
		visitas.placa AS placa_visitas,
		visitas.modelo AS modelo_visitas,
		visitas.empresa AS empresa_visitas,

        visitas.portaria AS portaria_visitas,
		visitas.data AS data_visitas,
		visitas.resp AS resp_visitas,
		visitas.descricao AS descricao_visitas,
        visitas.cor AS cor_visitas
    FROM 
        portaria
    INNER JOIN 
       visitas 
    ON 
        portaria.rg = visitas.rg";

$resultado_user = mysqli_query( $conn, $result_user );
$qnt_linhas = mysqli_num_rows( $resultado_user );

//Obter os dados a serem apresentados

$result_ramais = "SELECT 
	    /* tabela portaria*/
        portaria.rg AS rg_portaria, 
        portaria.nome AS nome_portaria, 
		/* tabela visitas*/
        visitas.rg AS rg_visitas,
		visitas.destino AS destino_visitas,
		visitas.placa AS placa_visitas,
		visitas.modelo AS modelo_visitas,
		visitas.empresa AS empresa_visitas,

        visitas.portaria AS portaria_visitas,
		visitas.data AS data_visitas,
		visitas.resp AS resp_visitas,
		visitas.descricao AS descricao_visitas,
        visitas.cor AS cor_visitas
    FROM 
        portaria
    INNER JOIN 
       visitas 
    ON 
        portaria.rg = visitas.rg WHERE 1";

if ( !empty( $requestData[ 'search' ][ 'value' ] ) ) {
    // se houver um parâmetro de pesquisa, $requestData[ 'search' ][ 'value' ] contém o parâmetro de pesquisa
    $result_ramais.=" AND (portaria.rg LIKE '".$requestData['search']['value']."%'";
    $result_ramais.=" OR portaria.nome LIKE '".$requestData['search']['value']."%'";
    $result_ramais.=" OR visitas.data LIKE '".$requestData['search']['value']."%'";
    $result_ramais.=" OR visitas.placa LIKE '".$requestData['search']['value']."%')";

}

$resultado_ramais = mysqli_query( $conn, $result_ramais );
$totalFiltered = mysqli_num_rows( $resultado_ramais );

//Ordenar o resultado
$result_ramais .= ' ORDER BY '. $columns[ $requestData[ 'order' ][ 0 ][ 'column' ] ].'   '.$requestData[ 'order' ][ 0 ][ 'dir' ].'  LIMIT '.$requestData[ 'start' ].' ,'.$requestData[ 'length' ].'   ';

$resultado_ramais = mysqli_query( $conn, $result_ramais );

// Ler e criar o array de dados
$dados = array();
while( $row_ramais = mysqli_fetch_array( $resultado_ramais ) ) {
    
    $color = 'red';
    $estilos[1] = "background-color:{$color};font-size:12px;color:black;font-style:bold;font-family: Times New Roman, Times, serif;text-align: center; width: auto;";

    $dado = array();
    $dado[] = $row_ramais[ 'nome_portaria' ];
    $dado[] = $row_ramais[ 'destino_visitas' ];
    $dado[] = $row_ramais[ 'placa_visitas' ];
    $dado[] = $row_ramais[ 'modelo_visitas' ];
    $dado[] = $row_ramais[ 'cor_visitas' ];
    $dado[] = $row_ramais[ 'empresa_visitas' ];
    $dado[] = $row_ramais[ 'portaria_visitas' ];
    $dado[] = $row_ramais[ 'data_visitas' ];
    $dado[] = $row_ramais[ 'resp_visitas' ];
    $dado[] = $row_ramais[ 'descricao_visitas' ];
    
    $dados[] = $dado;
  
}

//Cria o array de informações a serem retornadas para o Javascript

$json_data = array(
    'draw' => intval( $requestData[ 'draw' ] ), //para cada requisição é enviado um número como parâmetro
    'recordsTotal' => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
    'recordsFiltered' => intval( $totalFiltered ), //Total de registros quando houver pesquisa
    'data' => $dados   //Array de dados completo dos dados retornados da tabela
);

echo json_encode( $json_data );
//enviar dados como formato json