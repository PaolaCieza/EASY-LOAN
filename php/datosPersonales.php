<?php
    require_once("conexion.php");
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $sql="SELECT *,(case when sexo=true then 'Masculino' else 'Femenino' end) as genero from cliente where idcliente=$idcliente";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        $reg = $result->fetchObject()
?>
        <form>
            <div class="form-group">
                <label for="txtnombre">NOMBRE</label> 
                <input type="text" class="form-control" name="txtnombre" id="txtnombre" value="<?=$reg->nombre?>" readonly required> 
                
            </div>
            <div class="form-group">
                <label for="txtapellidos">APELLIDOS</label> 
                <input type="text" class="form-control" name="txtapellidos" id="txtapellidos" value="<?=$reg->apellido?>" readonly required>
                
            </div>
            <div class="form-group">
                <label for="txtdni">DNI</label> 
                <input type="text" class="form-control" name="txtdni" id="txtdni"  value="<?=$reg->dni?>" readonly required> 
                
            </div>
            <div class="form-group">
                <label for="txtfecha">FECHA DE NACIMIENTO</label> 
                <input type="date" class="form-control" name="txtfecha" id="txtfecha" value="<?=$reg->fechanac?>" readonly required> 
                
            </div>
            <fieldset class="form-group">
            <label>SEXO</label> <br>
            <input type="text" class="form-control" name="txtsexo" id="txtsexo" value="<?=$reg->genero?>" readonly required> 
                
            </fieldset>
            <div class="form-group">
                <label for="txtcorreo">CORREO</label> 
                <input type="email" class="form-control" name="txtcorreo" id="txtcorreo" value="<?=$reg->email?>" readonly required> 
                
            </div>
            <div class="form-group">
            <label for="txtusuario">USUARIO</label>
            <input type="text" class="form-control" readonly name="txtusuario" id="txtusuario" value="<?=$reg->usuario?>" required> 
            </div>
        </form>
        
<?php
        
    }
    