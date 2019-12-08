<?php
    require_once("conexion.php");
    $cliente = $_POST['cliente'];
    $opcion = $_POST['opcion'];
    switch ($opcion){
        case 0:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente";           
            break;
        case 1:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente order by p.fecharegistro desc";          
            break;
        case 2:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente order by p.fecharegistro asc";            
            break;
        case 3:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente order by p.monto asc";           
            break;
        case 4:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente order by p.monto desc";            
            break;
        case 5:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente and p.estado=false";            
            break;
        case 6:
            $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario,p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
            (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
            on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
            cliente c on s.idcliente=c.idcliente where r.idcliente=$cliente and p.estado=true";            
            break;
    };
    
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
                                class="font-weight-bold ">PRESTATARIO:</label> <?=$reg->prestatario?>
                        </h1><br>
                        <label>FECHA: <?=$reg->fecharegistro?> </label> <br>
                        <label>MONTO PRESTADO: S/<?=$reg->monto?></label> <br>
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