<?php
    require_once("conexion.php");
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $nombre = $_POST['nombre'];
    $sql="SELECT s.idsolicitud, c.nombre ||' '||c.apellido as solicitante, c.fotousuario,c.dni,s.monto::numeric, 
    (case when s.periodo=true then 'Mensual' else 'Semanal' end) as periodo, s.numerocuotas, s.fecha
    from solicitud s left join respuesta r on r.idsolicitud=s.idsolicitud 
    left join prestamo p on r.idrespuesta=p.idrespuesta 
    inner join cliente c on c.idcliente=s.idcliente
    where p.idprestamo is null and s.estado is not false and (r.idcliente != $idcliente or r.idcliente is null) and s.idcliente!=$idcliente 
    and (upper(c.nombre) like upper('%$nombre%') or upper(c.apellido) like upper('%$nombre%'))";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>  
            <div class="col-lg-6 bg-fondito-nivel border">
                <div class="row">
                    <div class="col-lg-4">
                        <br>
                        <img src="../recursos/perfiles/<?=$reg->fotousuario?>" class="perfil_prestamista_prestatario rounded-circle ">
                    </div>
                    <div class="col-lg-8 mt-1">
                        <div class="row justify-content-end p-1">
                            <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalDarPrestamo"
                            data-whatever="@mdo" onclick="darPrestamo(<?=$reg->idsolicitud?>, <?=$reg->monto?>)">DAR PRESTAMO</button>
                        </div>
                        <div class="">
                            <label for=""> PRESTATARIO:  <?=$reg->solicitante?></label> <br>
                            <label for=""> DNI: <?=$reg->dni?></label> <br>
                            <label for=""> FECHA: <?=$reg->fecha?></label> <br>
                            <label for=""> MONTO: <?=$reg->monto?></label> <br>
                            <label for=""> PERIODO: <?=$reg->periodo?></label>
                            <label for=""> CUOTAS: <?=$reg->numerocuotas?></label>
                        </div>
                    </div>
                </div>
            </div>
<?php        
        }
    }
    else{
?>
<?php
    }