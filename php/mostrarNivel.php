<?php
require_once("conexion.php");
session_start();
$idcliente = $_SESSION['idusuario'];
$sql="SELECT c.nombre as usuario, n.idnivel, n.nombre, n.descripcion,n.imagen 
from cliente c inner join nivel n on n.idnivel=c.idnivel where c.idcliente=$idcliente";
$result = $cnx->query($sql);
if($reg = $result->fetchObject()){
    echo "
            <div class='form-group'>
                <center> <img src='../recursos/niveles/$reg->imagen' alt='' width='120px'></center>
            </div>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>USTED SE ENCUENTRA EN EL
                    NIVEL</label>
                <input type='text'
                    class='form-control border-top-0 border-left-0 border-right-0 border-dark bg-transparent'
                    id='recipient-name' readonly value='$reg->nombre'>
            </div>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>¿QUÉ PUEDES HACER AQUÍ?
                </label>
                <!-- <input type='text' class='form-control' id='recipient-name' readonly> -->
                <ul>
                    <li>$reg->descripcion</li>
                </ul>
            </div>
    ";
}