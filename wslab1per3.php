<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';

$server->register('alumno',
                array('nombre'=>'xsd:string'),
                array('return'=>'xsd:string'),
                'urn:server',
                'urn:server#alumnoServer',
                'rpc',
                'encoded',
                'Funcion Hola Mundo en un Webservice.'
);

$server->register('promedio',
                array('lab1'=>'xsd:float','lab2'=>'xsd:float','parcial'=>'xsd:float'),
                array('resultado'=>'xsd:float'),           
                'urn:server',
                'urn:server#promedioServer',
                'rpc',
                'encoded',
                'Funcion para calcular el promedio'
);

function alumno($nombre) {
    return "El promedio del alumno: $nombre es:  ";
}

function promedio($lab1, $lab2, $parcial) {
    $total = ($lab1 * 0.25) + ($lab2 * 0.25) + ($parcial * 0.5);
    return $total;
}

$server->service(file_get_contents("php://input"));

