<?php
require_once("conexion.php");
$idprestamo = $_POST['idprestamo'];
$sql="SELECT * from cuota c where c.idprestamo=$idprestamo and estado=false 
order by numerocuota asc limit 1";
$result = $cnx->query($sql);
if($result->rowCount() != 0){
    while($reg = $result->fetchObject()){    
?>  
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>N° CUOTA</label>
                <input type='text' class='form-control' id='ncuota' value='<?=$reg->numerocuota?>' readonly>
                <input id="idcuota"  type="hidden" value="<?=$reg->idcuota?>">
            </div>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>MONTO</label>
                <input type='text' class='form-control' id='cmonto' value='<?=$reg->montocuota?>' readonly>
            </div>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>MORA</label>
                <input type='text' class='form-control' id='cmora' value='<?=$reg->montomora?>' readonly>
            </div>
            <div class='form-group'>
                <label for='recipient-name' class='col-form-label'>VENCIMIENTO</label>
                <input type='text' class='form-control' id='cvencimiento' value='<?=$reg->fechavencimiento?>' readonly>
            </div>
            <div class='modal-footer'>
                <button type='button' class='button btn btn-success' onclick='procesarPago()'>PAGAR</button>
            </div>
<?php
    }

}
else{
?>

    <!-- aqui va html-->


<?php
}