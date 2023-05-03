<?php

    include("conexion.php");

    $user = $_POST['Usuario'];
    $password = $_POST['Password'];
    




    $conex = new conexion;
    $conex->login($user, $password);
    $conex->cerrar();

?>