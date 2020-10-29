<?php
#Sirve para cambiar el nivel de reporte de errores, porque sino salen puras advertencias.
include("conexion.php");
if($_POST){
    if(isset($_POST['humedad']) && !is_null($_POST['humedad'])&&isset($_POST['temperatura']) && !is_null($_POST['temperatura']))
    {
        $humedad = $_POST['humedad'];
        $temperatura = $_POST['temperatura'];
        $sql_agregar = "INSERT INTO datos (humedad, temperatura) VALUES (?,?);";
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array($humedad,$temperatura));

        

        $sentencia_agregar = null;
        $pdo = null;

        echo "Datos ingresados correctamente!";
    }
    
    
}


?>