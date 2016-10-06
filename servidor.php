<?php

require_once ('nusoap-0.9.5/lib/nusoap.php');

$servidor = new nusoap_server();

$servidor->configureWSDL('urn:Servidor');
$servidor->wsdl->schemaTagetNamespace = 'urn:Servidor';

$servidor->register(
  'exemplo',
    array('menssagem' => 'xsd:string'),
    array('retorno' => 'xsd:string'),
    'urn:Servidor.exemplo',
    'urn:Servidor.exemplo',
    'rpc',
    'encoded',
    'SOAP PHP'
);

function exemplo($menssagem)
{
    return($menssagem);
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : 'falhou';
$servidor->service($HTTP_RAW_POST_DATA);

/*Salva XML em um arquivo*/
$f = fopen('arquivo.xml','w');
fwrite($f,$HTTP_RAW_POST_DATA);
fclose($f);

/*Lê XML do arquivo*/
$arquivo = "arquivo.xml";
$f = fopen($arquivo, "rb");
$arquivo = fread($f, filesize($arquivo));
$DOMDocument = new DOMDocument( '1.0' , 'utf-8' );
@$DOMDocument->loadXML($arquivo);
$valor =  $DOMDocument->getElementsByTagName('menssagem')->item( 0 )->nodeValue;

/*Salva no banco de dados*/
$con  = new PDO("mysql:host=localhost;dbname=chat","root","root");
$stmt = $con->prepare("INSERT INTO msg(msg) VALUES(:msg)");
$stmt->bindValue(':msg', $valor);
$stmt->execute();
