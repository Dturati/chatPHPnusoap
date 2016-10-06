<script src="javascript/jquery.min.js"></script>

<?php

require_once ('nusoap-0.9.5/lib/nusoap.php');

$cliente = new nusoap_client("http://192.168.15.11:8081/servidor.php?wsdl");
$cliente->wsdl = array("useMTOM" => TRUE);
$nome = $_GET['nome'];

if($nome != "") {
    $base64 = base64_encode($nome);
    $parametros = array('menssagem' => $base64);
}

$resultado = $cliente->call('exemplo', $parametros);
//$con  = new PDO("mysql:host=localhost;dbname=chat","root","root");
//$stmt = $con->prepare("INSERT INTO msg(msg) VALUES(:msg)");
//$stmt->bindValue(':msg', $resultado);
//$stmt->execute();
//$resultado = $_COOKIE['msg'] . $resultado . '<br>';
//setcookie('msg', $resultado);
?>

<html>
<head>
    <title>
        Chat SD
    </title>
    <meta charset="UTF-8">
</head>
<body>

      <h3>Trabalho de sistemas distribuídos</h3>
      <form id="formulario">
          <input type="text" id="nome" name="nome">
          <input type="submit" value="Enviar">
      </form>

      <form id="formulario" name="formulario">
          <p class="resposta" id="respostaAjax" name="respostaAjax"> </p>
      </form>
      <script src="javascript/script.js"></script>
      <link rel="stylesheet" href="css/chat.css">
      </body>

</html>
<?php
