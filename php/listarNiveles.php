<?php
    require_once("conexion.php");
    $sql="SELECT * from nivel";
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
                <div class=" row justify-content-end">
                    <button class="btn btn-outline-light m-4" data-toggle="modal"
                    data-target="#modalEditarNivel" data-whatever="@mdo">EDITAR</button>
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