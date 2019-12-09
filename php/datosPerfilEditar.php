<?php
    require_once("conexion.php");
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $sql="SELECT *,(case when sexo=true then 'Masculino' else 'Femenino' end) as genero from cliente where idcliente=$idcliente";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        $reg = $result->fetchObject();
        echo json_encode($reg);
    }
?>