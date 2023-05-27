<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';

$server->register('hola',
                array('usuario'=>'xsd:string'),
                array('return'=>'xsd:string'),
                'urn:server',
                'urn:server#holaServer',
                'rpc',
                'encoded',
                'Funcion Hola Mundo en un Webservice.'
);

$server->register('sumatoria',
                array('v1'=>'xsd:int','v2'=>'xsd:int'),
                array('resultado'=>'xsd:int'),
                'urn:server',
                'urn:server#sumatoriaServer',
                'rpc',
                'encoded',
                'Funcion para calcular la sumatoria entre dos numeros'

);

$server->wsdl->addComplexType(
    'Persona',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_user'=>array('name'=>'id_user','type'=>'xsd:int'),
        'fullname'=>array('name'=>'fullname','type'=>'xsd:string'),
        'email'=>array('name'=>'email','type'=>'xsd:string'),
        'msg'=>array('name'=>'msg','type'=>'xsd:string'),
        'level'=>array('name'=>'level','type'=>'xsd:string')
    )
);

$server->register(
    'login',
    array('username'=>'xsd:string','password'=>'xsd:string'),
    array('return'=>'tns:Persona'),
    'urn:server',
    'urn:server#loginServer',
    'rpc',
    'encoded',
    'Funcion para validar credenciales.'
);

function login($username, $password) {
    if (($username=="admin") && ($password=="catolica")) {
        $valor=array(
            'id_user'=>1,
            'fullname'=>'Juana de Lopez',
            'email'=>'juana@gmail.com',
            'msg'=>'Usuario Correcto',
            'level'=>1
        );
    } else {
        $valor=array(
            'id_user'=>0,
            'fullname'=>'',
            'email'=>'',
            'msg'=>'Usuario Incorrecto',
            'level'=>0
        );
    }
    return $valor;
}

function hola($usuario) {
    return "Bienvenido $usuario";
}

function sumatoria($v1,$v2) {
    $total=0;
    for ($i=$v1;$i<=$v2;$i++){
        $total+=$i;
    }
    return $total;
}

$server->service(file_get_contents("php://input")); 

/*
v1=5
v2=15
resiltado=5+6+7+8..15
*/