<?php
    require_once("conexion.php");
    $idcuota = $_POST['idcuota'];
    $sql="UPDATE public.cuota SET estado=true WHERE idcuota=$idcuota;";
    $resp = 1;
    $result = $cnx->query($sql) or $resp = 0;
    echo $resp;