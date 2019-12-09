<?php
    require_once("conexion.php");
    session_start();
    $sesion = $_SESSION['usuario'];
    $usuario = $_POST['txtusuario'];
    if($usuario != $sesion){
        $sql = "SELECT * FROM cliente WHERE usuario ='$usuario' ";
        $rs = $cnx->query($sql) or die($sql);
        echo $cantidad_registros = $rs->rowCount();	
    }
    else{
        echo 0;
    }