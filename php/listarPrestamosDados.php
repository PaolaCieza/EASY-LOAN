<?php
    require_once("conexion.php");
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $sql="SELECT c.nombre ||' '||c.apellido as prestatario, c.fotousuario, c.dni, p.fecharegistro, p.monto,p.numerocuotas, p.tasainteres*100 as interes,
    (case when p.estado=true then 'Pagado' else 'Pendiente' end) estado from prestamo p inner join respuesta r 
    on r.idrespuesta=p.idrespuesta inner join solicitud s on s.idsolicitud=r.idsolicitud inner join 
    cliente c on s.idcliente=c.idcliente where r.idcliente=$idcliente";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>  
            <div class="row form-group border">
                <div class="col-lg-4">
                    <br>
                <center><img src="../recursos/perfiles/<?=$reg->fotousuario?>" alt=""
                        class="rounded-circle perfil_prestamista_prestatario"></center>
                </div>
                <div class="col-lg-8">
                    <label for="">  ESTADO: <?=$reg->estado?></label> <br>
                    <label for="">  NOMBRE: <?=$reg->prestatario?></label><br>
                    <label for="">  DNI: <?=$reg->dni?></label><br>
                    <label for="">  MONTO:</label><br> 
                    <label for="">  CUOTAS PAGADAS: </label> <br>
                    <label for="">  CUOTAS TOTALES: <?=$reg->numerocuotas?></label><br>
                </div>
                                            
            </div>
<?php        
        }
    }
    else{
?>
        
            
<?php
    }