<?php
require "vendor/autoload.php";
$url="http://localhost/webservice/ws.php?wsdl";
$cliente=new nusoap_client($url,'wsdl');
$error=$cliente->getError();
if ($error){
    echo "Error de conexion con el webservice: $error";
}

$parametros=array('v1'=>$_POST["$v1"],'v2'=>$_POST["$v2"]);
$resultado=$cliente->call('sumatoria',$parametros);
//print_r($resultado);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma </title>
</head>
<body>
    <form action="" method="post">
            Valor 1: <input type="text" name="v1" id="v1">
            Valor 2: <input type="text" name="v2" id="v2">
            <br>
            
            <input type="submit" value="Enviar">
    </form>
</body>
</html>