<?php
    require_once("conexion.php");
    $opcion = $_POST['opcion'];
    $buscar = $_POST['buscar'];
    switch ($opcion){
        case 1:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where upper(c.dni) like upper('%$buscar%') and c.tipoacceso=true and c.vigencia=true";
            break;
        case 2:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where (upper(c.nombre) like upper('%$buscar%') or upper(c.apellido) like upper('%$buscar%'))
            and c.tipoacceso=true and c.vigencia=true";
            break;
        case 3:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where upper(c.usuario) like upper('%$buscar%') and c.tipoacceso=true and c.vigencia=true";
            break;
    };
    
    $result = $cnx->query($sql);
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
            $sqlPrestatario="SELECT count(*) as prestatario from prestamo p inner join respuesta r on r.idrespuesta=p.idrespuesta 
            inner join solicitud s on s.idsolicitud=r.idsolicitud where s.idcliente=$reg->idcliente";
            $resultPrestatario = $cnx->query($sqlPrestatario);
            $sqlPrestamista="select count(*) as prestamista from respuesta where estado=true and idcliente=$reg->idcliente";
            $resultPrestamista = $cnx->query($sqlPrestamista);
    ?>
        <div  class="container-fluid mt-1 mb-3 bg-transparent rounded align-content-center div-usu-man">
            <div class="row font-weight-bold ">
                <div class="col-sm-3  border-right">
                    <div class="col-1">
                        <label for="" class="bg-warning p-1 font-weight-bold"><?=$reg->idcliente?></label>
                    </div>
                    <div class="col-12 justify-content-center">
                        <center>
                            <img src="../recursos/perfiles/<?=$reg->fotousuario?>" alt=""
                                class="rounded-circle perfil_user_mantenimiento imgperf9">
                            <label for="" class="m-1"> <?=$reg->fechanac?> </label>
                        </center>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row p-3 justify-content-between">
                        <label for=""><?=$reg->nombre?> <?=$reg->apellido?></label> <label for=""><?=$reg->dni?></label>

                    </div>
                    <div class="row justify-content-center p-5">
                        <center>
                            <h1 class="text-warning text-uppercase text-nivel"> <label for=""><?=$reg->nivel?> </label>
                            </h1>
                        </center>
                    </div>
                    <div class="row justify-content-around p-2">
                        <button class="btn btn-outline-purple" type="button" data-toggle="modal"
                            data-target="#modalContactar" data-whatever="@mdo" onclick="contactarCliente(<?=$reg->idcliente?>)">CONTACTAR</button>
                        <button class="btn btn-outline-purple" type="button" data-toggle="modal"
                            data-target="#modalDarBaja" data-whatever="@mdo" onclick="bajaCliente(<?=$reg->idcliente?>)">DAR DE BAJA</button>
                        <button class="btn btn-outline-purple">PDF</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 p-0 d-flex   flex-column font-weight-bold align-middle">
                    <button class="border-0 bg-transparent" style="height: 20%;"> </button>
                    <button class="btn btn-outline-success mb-1 border-right-0 " style="height: 30%;" type="button"
                        data-toggle="modal" data-target="#modalPrestamista" data-whatever="@mdo" onclick="listarPrestamista(<?=$reg->idcliente?>)">
                        <h2 class=""> PRESTAMISTA </h2>
                        <label for=""> <?=$resultPrestamista->fetchObject()->prestamista?></label>
                    </button>
                    <button class="btn btn-outline-info border-right-0 " style="height: 30%;" type="button"
                        data-toggle="modal" data-target="#modalPrestatario" data-whatever="@mdo" style="height: 30%;" onclick="listarPrestatario(<?=$reg->idcliente?>)">
                        <h2> PRESTATARIO </h2>
                        <label for=""><?=$resultPrestatario->fetchObject()->prestatario?></label>
                    </button>
                    <button class="border-0 bg-transparent" style="height: 20%;"> </button>
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