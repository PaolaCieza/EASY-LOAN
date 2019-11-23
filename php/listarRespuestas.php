<?php
    require_once("conexion.php");
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $sql="SELECT r.idrespuesta, c.nombre ||' '||c.apellido as prestamista, r.tasainteres*100 as interes, c.fotousuario,
    s.numerocuotas, (case when s.periodo=true then 'MENSUALES' else 'SEMANALES' end) as periodo
    from respuesta r inner join cliente c
    on c.idcliente=r.idcliente inner join solicitud s on r.idsolicitud=s.idsolicitud
    where r.idsolicitud = (select idsolicitud from solicitud where estado=true and idcliente= $idcliente order by 1 desc limit 1 )
    and r.estado is null;
    ";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>  
            <div class='form-group border border-success p-3'>
                <div class='row'>
                    <div class='col-lg-4'>
                        <img src='../recursos/perfiles/<?=$reg->fotousuario?>' alt='' width='100px' class='rounded-circle'>
                    </div>
                    <div class='col-lg-8'>
                            <label for='recipient-name' class='col-form-label'><?=$reg->prestamista?></label><br>
                            <label for=''>INTERÉS: </label>
                            <label for='lblPorcentaje'><?=$reg->interes?>%</label><br>
                            <label for='lblPorcentaje'><?=$reg->numerocuotas?> CUOTAS <?=$reg->periodo?></label>
                            <div class='modal-footer'>
                                    <button type='button' class='btn btn-outline-secondary'
                                        data-dismiss='modal'>RECHAZAR</button>
                                    <button type='button' class='btn btn-outline-danger' onclick='aceptarRespuesta(<?=$reg->idrespuesta?>)'>ACEPTAR</button>
                            </div>
                    </div>
                </div>
            </div>   
<?php        
        }
    }
    else{
?>
        <div class='  border border-warning btn-outline-light '>
            <div class='justify-content-center row align-content-center' height='600px'>
            <img src='../recursos/emojiTriste.png' width='100vh' class='spinner-border-web'>   
            </div>
            <div class='justify-content-center row align-content-center '>
            <h2 class=' font-weight-bold text-purple'>USTED AÚN NO TIENE RESPUESTAS</h2>
            </div>
        </div>
            
<?php
    }

