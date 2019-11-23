<?php
    require_once("conexion.php");
    $p = $_POST['pag'];
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $cant=10;
    $inicio=($p-1)*$cant;
    $sql="SELECT p.idprestamo, c.nombre ||' '||c.apellido as prestamista,p.monto,p.numerocuotas, 
    (case when p.estado=true then 'Pagado' else 'Pendiente' end) as estado, p.fechaRegistro
    from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta 
    inner join solicitud s on r.idsolicitud=s.idsolicitud
    inner join cliente c on r.idcliente=c.idcliente
    where s.idCliente=$idcliente OFFSET $inicio LIMIT $cant";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>
                <tr>
                    <td><?=$reg->idprestamo?></td>
                    <td><?=$reg->prestamista?></td>
                    <td><?=$reg->monto?></td>
                    <td><?=$reg->numerocuotas?></td>
                    <td><?=$reg->estado?></td>
                    <td><?=$reg->fecharegistro?></td>
                    <td class='p-2' >
                    <button type='button' class='bg-transparent border-0 m-0' data-toggle='modal'
                    data-target='#modaListarCuotas' data-whatever='@mdo' onclick='listarCuotas(<?=$reg->idprestamo?>)'>  <img src='../recursos/listarCuotasG.png' >
                    </button>
                    </td>
                    <td class='p-2' >
                    <button type='button' class='bg-transparent border-0 m-0' data-toggle='modal'
                    data-target='#modalPagar' data-whatever='@mdo' onclick='datosCuota(<?=$reg->idprestamo?>)'> <img src='../recursos/pagar.png' >
                    </button>
                    </td>
                </tr>
<?php
        }
    }
    
    