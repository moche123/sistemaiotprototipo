<?php



$link = 'mysql:host=localhost;dbname=frigorifico';
$usuario = 'root';
$pass = '';

try {
    $pdo = new PDO($link,$usuario,$pass);

    //echo '<br> conectado <br>';
    /*echo '<hr>';
    foreach($pdo->query('SELECT * from `color`') as $fila) {
        print_r($fila);
        echo '<hr>';
    }*/


} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}