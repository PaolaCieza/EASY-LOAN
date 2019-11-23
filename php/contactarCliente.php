<?php
    require_once("conexion.php");
    $cliente = $_POST['cliente'];
    $sql="SELECT email,(case when telefono is null then 'No registrado' else telefono end) as telefono,
    (case when direccion is null then 'No registrada' else direccion end) as direccion,fotousuario
     from cliente  where idcliente=$cliente";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
    ?>
        <div class="form-group border border-purple  p-3">
            <div class="row">
                <div class="col-lg-4">
                    <img src='../recursos/perfiles/<?=$reg->fotousuario?>' alt='prestatario' width="100px"
                        class="rounded-circle">
                </div>
                <div class="col-lg-8">
                    <form action="">
                        <div class="form-group">
                                <label for="txtCorreo"> CORREO</label>
                                <input type="text" class="form-control border border-danger border-left-0 border-top-0 border-right-0 bg-white" value="<?=$reg->email?>" readonly>
                        </div>
                        <div class="form-group">
                                <label for="txtTelefono"> TELÉFONO </label>
                                <input type="text" class="form-control border border-danger border-left-0 border-top-0 border-right-0 bg-white" value="<?=$reg->telefono?>" readonly>
                        </div>
                        <div class="form-group">
                                <label for="txtDireccion"> DIRECCIÓN</label>
                                <input type="text" class="form-control border border-danger border-left-0 border-top-0 border-right-0 bg-white" value="<?=$reg->direccion?>" readonly>
                        </div>
                    </form>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
    <?php
    }
    }
    else{
    ?>
        <!-- aqui va html -->

    <?php
    }