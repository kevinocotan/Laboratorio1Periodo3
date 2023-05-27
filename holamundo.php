<?php
if (isset($_POST["usuario"])) {
    require "vendor/autoload.php";
    $url="http://localhost/webservice/ws.php?wsdl";
    $cliente=new nusoap_client($url,'wsdl');
    $error=$cliente->getError();
    if ($error){
        echo "Error de conexion con el webservice: $error";
    }

    $parametros=array("usuario"=>$_POST["usuario"]);
    $resultado=$cliente->call('hola',$parametros);
    print_r($resultado);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo Web Service </title>
</head>
<body>
    <form action="" method="post">
            Digite su nombre: <input type="text" name="usuario" id="usuario">
            <br>
            <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php
}
?>
