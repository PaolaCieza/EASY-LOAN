<?php
    require_once("conexion.php");
    $sql="SELECT * from nivel order by 1 asc";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
            $sqlCientes="SELECT count(*) as clientes from cliente where idnivel=$reg->idnivel and vigencia=true";
            $resultClientes = $cnx->query($sqlCientes);
?>
            <div class="col-lg-4 border border-white p-4 rounded bg-fondito-nivel mb-2">
                <div>
                    <label for="" class="text-body font-weight-light">USUARIOS: <label for=""><?= $resultClientes->fetchObject()->clientes?></label></label>
                </div>
                <div class="row justify-content-center">
                    <img src="../recursos/niveles/<?=$reg->imagen?>" alt="" class=" perfil_user_mantenimiento img-Nivel">
                </div>
                <div>
                    <h1>
                        <label for="" class="text-purple font-weight-bold"><?=$reg->nombre?></label>
                    </h1>
                </div>
                <div>
                    <label for="" class="text-body font-weight-bold text-justify"><?=$reg->descripcion?></label>
                </div>
                <div class="row justify-content-end">
                <label for="" class="font-weight-bold m-3 text-white">Monto máximo 
                <label for="" class="text-warning"> <?=$reg->montomax?> </label>    
                 </label>

                </div>
                <div class=" row justify-content-end mb-1">
                    <button class="btn btn-outline-light m-4" data-toggle="modal"
                    data-target="#modalEditarNivel" data-whatever="@mdo" onclick="datosNivel(<?=$reg->idnivel?>)">EDITAR</button>
                </div>
            </div>
    
<?php
        }
    }
    else{
?>
    <div class="row border border-warning">
        <label for="" class="text-purple"> NO HAY NIVELES</label>
    </div>

<?php
    }