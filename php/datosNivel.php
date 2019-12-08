<?php
    require_once("conexion.php");
    $nivel = $_POST['nivel'];
    $sql="SELECT * from nivel where idnivel=$nivel";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        $reg = $result->fetchObject();
        echo json_encode($reg);
    }
 