<?php
session_start();
include_once 'conexion.php';

$usuario_login = $_POST['email'];
$contrasena_login = $_POST['password'];


//VERIFICAR SI EXISTE EL USUARIO
$sql = 'SELECT * FROM users WHERE email = ?';
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($usuario_login));
$resultado = $sentencia->fetch();


if(!$resultado){
    //matar la operacion
    echo 'No existe usuario';
    die();
}
if(password_verify($contrasena_login,$resultado['password'])){
   $_SESSION['admin'] = $usuario_login;
   $_SESSION['username'] = $resultado['username'];
   $_SESSION['password'] = $resultado['password'];
   $_SESSION['id'] = $resultado['id'];
   $_SESSION['email'] = $resultado['email'];
   $_SESSION['enterprise'] = $resultado['enterprise'];
   $_SESSION['firstname'] = $resultado['firstname'];
   $_SESSION['lastname'] = $resultado['lastname'];
   $_SESSION['adress'] = $resultado['adress'];
   $_SESSION['city'] = $resultado['city'];
   $_SESSION['country'] = $resultado['country'];
   $_SESSION['postcode'] = $resultado['postcode'];
   $_SESSION['aboutme'] = $resultado['aboutme'];
   header('Location: cuenta.php') ;
}else{
    echo 'Contraseña incorrecta';
    die(); 
}






?>