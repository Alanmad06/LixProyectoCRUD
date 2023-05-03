<?php

include("conexion.php");
  $nombre = $_POST['nombre'];
  $ape = $_POST['apellido'];
  $user = $_POST['user'];
  $pass = $_POST['password'];
  $cpass = $_POST['cpassword'];

  $conex = new conexion;

  if($pass != $cpass){
    
    echo "<script> alert('Contraseñas no coinciden');</script>";
  }
  else{  $conex->registrer($user,$pass,$nombre,$ape);

  
  }

  $conex->cerrar();



 
?>