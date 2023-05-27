<?php
if (isset($_POST["lab1"])) {
    require "vendor/autoload.php";
    $url="http://172.19.1.133/webservice/wslab1per3.php?wsdl";
    $cliente=new nusoap_client($url,'wsdl');
    $error=$cliente->getError();
    if ($error) {
        echo "Error en conexion con el webservice: $error";
    }

    $nombre=array("nombre"=>$_POST["nombre"]);
    $resultado1=$cliente->call('alumno',$nombre);
    print_r($resultado1);   

    $notas=array("lab1"=>$_POST["lab1"], "lab2"=>$_POST["lab2"], "parcial"=>$_POST["parcial"],);
    $resultado2=$cliente->call('promedio',$notas);
    print_r($resultado2);

} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>PROMEDIO DE NOTAS</title>
    </head>
    <body>
    <form action="" method="post">
            <div class="form-group" >
                <label for="formGroupExampleInput">Nombre del Alumno: </label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2"> Nota del Primer Laboratorio:</label>
                <input type="float" class="form-control" name="lab1" id="lab1" placeholder="Laboratorio 1">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2"> Nota del Segundo Laboratorio:</label>
                <input type="float" class="form-control" name="lab2" id="lab2" placeholder="Laboratorio 2">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2"> Nota del Parcial:</label>
                <input type="float" class="form-control" name="parcial" id="parcial" placeholder="Parcial">
            </div>
            <br>
            <button type="submit"  value="Enviar" class="btn btn-primary">Calcular</button>
        </form>
    </body>
    </html>
<?php 
}
?>

     