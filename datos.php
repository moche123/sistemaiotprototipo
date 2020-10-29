<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

//$datos = ['dolar'=>400,'euro'=>700];
//$peticion = $_GET['moneda'];

    include_once 'conexion.php';
    $solicitud = "SELECT * FROM datos";
    $sentencia = $pdo->prepare($solicitud);
    $sentencia->execute();
    $datos = $sentencia->fetchAll();

    echo json_encode($datos);