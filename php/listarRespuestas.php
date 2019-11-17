<?php
require_once("conexion.php");
session_start();
$idcliente = $_SESSION['idusuario'];
$sql="SELECT c.nombre ||' '||c.apellido as prestamista, r.tasainteres*100 as interes, c.fotousuario from respuesta r inner join cliente c
on c.idcliente=r.idcliente where r.idsolicitud = 1 ";
$result = $cnx->query($sql);
while($reg = $result->fetchObject()){
        echo "
        <div class='form-group border border-success p-3'>
            <div class='row'>
                <div class='col-lg-4'>
                    <img src='../recursos/perfiles/$reg->fotousuario' alt='' width='100px' class='rounded-circle'>
                </div>
                <div class='col-lg-8'>
                        <label for='recipient-name' class='col-form-label'>$reg->prestamista</label><br>
                        <label for=''>INTERÉS: </label>
                        <label for='lblPorcentaje'>$reg->interes%</label>
                        <div class='modal-footer'>
                                <button type='button' class='btn btn-outline-secondary'
                                    data-dismiss='modal'>RECHAZAR</button>
                                <button type='button' class='btn btn-outline-danger'>ACEPTAR</button>
                        </div>
                </div>
            </div>
        </div>   
        ";
    }