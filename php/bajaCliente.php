<?php    
    require_once("conexion.php");
    $cliente = $_POST['cliente'];
    $sql="UPDATE public.cliente SET vigencia=false WHERE idcliente=$cliente;";
    $resp = 1;
    $result = $cnx->query($sql) or $resp = 1;
    echo $resp;