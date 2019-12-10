<?php
    require_once("conexion.php");
    $sql="SELECT * from nivel order by 1 asc";
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
?>
            <div class="row border border-white p-4 rounded bg-fondito-nivel-general mb-2">
                <div class="col-lg-3 ">
                    <h1 class="text-center ">
                        <label for="" class="text-white font-weight-bold">NIVEL <?=$reg->nombre?></label>
                    </h1>
                </div>

                <div class="col-lg-6 text-center ">
                    <img src="../recursos/niveles/<?=$reg->imagen?>" alt="" class=" perfil_user_mantenimiento img-Nivel">
                </div>

                <div class="col-lg-3 text-center  ">
                    <label for="" class="text-warning font-weight-bold text-justify "><?=$reg->descripcion?></label>
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