<?php
    //Script de conexión
    try {
        $host ="proyecto_agenda_tonisanchez-db-1";
        $nombreBD ="agenda";
        $usuario ="root";
        $password ="root";
        $pdo = new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8",$usuario, $password);

    } catch(PDOException $e){
        echo "Error: " . $e ->getMessage();
    }
?>