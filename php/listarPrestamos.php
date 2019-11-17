<?php
    require_once("conexion.php");
    $p = $_POST['pag'];
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $cant=10;
    $inicio=($p-1)*$cant;
    $sql="SELECT p.idprestamo, c.nombre ||' '||c.apellido as prestamista,p.monto,p.numerocuotas, 
    (case when p.estado=true then 'Pagado' else 'Pendiente' end) as estado, p.fecha
    from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta 
    inner join solicitud s on r.idsolicitud=s.idsolicitud
    inner join cliente c on r.idcliente=c.idcliente
    where s.idCliente=$idcliente OFFSET $inicio LIMIT $cant";
    $result = $cnx->query($sql);
    while($reg = $result->fetchObject()){
        echo "<tr>
                <td>$reg->idprestamo</td>
                <td>$reg->prestamista</td>
                <td>$reg->monto</td>
                <td>$reg->numerocuotas</td>
                <td>$reg->estado</td>
                <td>$reg->fecha</td>
            </tr>";
    }