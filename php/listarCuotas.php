<?php
require_once("conexion.php");
$idprestamo = $_POST['idprestamo'];
$sql="SELECT numerocuota, montocuota, fechavencimiento,(case when estado=true then 'PAGADO' else 'PENDIENTE' end) as estado
from cuota c where c.idprestamo=$idprestamo";
$result = $cnx->query($sql);
if($result->rowCount() != 0){
    while($reg = $result->fetchObject()){
        echo "
            <tr>
                <td>$reg->numerocuota</td>
                <td>$reg->montocuota</td>
                <td>$reg->fechavencimiento</td>
                <td>$reg->estado</td>
            </tr>
            ";
}
}
else{
    
}