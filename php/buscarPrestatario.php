<?php
    require_once("conexion.php");
    $cliente = $_POST['cliente'];
    $nombre = $_POST['nombre'];
    $sql="SELECT c.nombre ||' '||c.apellido as prestamista, c.fotousuario, p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
    (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
    on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
    cliente c on r.idcliente=c.idcliente where s.idcliente=$cliente and (upper(c.nombre) like upper('%$nombre%') or upper(c.apellido) like upper('%$nombre%'))";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>  
            <div class="form-group border border-info p-3">
                <div class="row">
                    <div class="col-lg-4">
                        <img src='../recursos/perfiles/<?=$reg->fotousuario?>' alt='prestatario' width="100px"
                            class="rounded-circle">
                    </div>
                    <div class="col-lg-8">
                        <h1 class="col-form-label text-btn"> <label for=""
                                class="font-weight-bold ">PRESTAMISTA:</label> <?=$reg->prestamista?>
                        </h1><br>
                        <label>FECHA: <?=$reg->fecharegistro?> </label> <br>
                        <label>MONTO PEDIDO: S/<?=$reg->monto?></label> <br>
                        <label>INTERÉS: <?=$reg->interes?>%</label> <br>
                        <label>CUOTAS: <?=$reg->numerocuotas?></label><br>
                        <label>ESTADO: <?=$reg->estado?></label><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-purple">GENERAR PDF</button>
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