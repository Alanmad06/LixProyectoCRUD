<?php

    include("conexion.php");

   
    $titulo = $_POST['Titulo'];
    $autor = $_POST['Autor'];
    $ano = $_POST['Año'];
    $nautor = $_POST['NAutor'];


    $conex = new conexion;
    $conex->insertLibro($titulo,$ano,$autor, $nautor);
    $conex->cerrar();

?>