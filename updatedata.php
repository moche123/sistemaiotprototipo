<?php
    session_start();
    include_once 'conexion.php';
    if($_POST){
        $firstn = $_POST['firstn'];
        $id = $_SESSION['id'];
        try{
            $sql = 'UPDATE users SET firstname=? where id=?';
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($firstn,$id));
            header("location:cuenta.php");
        }catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }
   
?>