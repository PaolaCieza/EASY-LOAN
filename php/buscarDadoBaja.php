<?php       
    require_once("conexion.php");
    $opcion = $_POST['opcion'];
    $buscar = $_POST['buscar'];
    switch ($opcion){
        case 0:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where c.tipoacceso=true and c.vigencia=false";
            break;
        case 1:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where upper(c.dni) like upper('%$buscar%') and c.tipoacceso=true and c.vigencia=false";
            break;
        case 2:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where (upper(c.nombre) like upper('%$buscar%') or upper(c.apellido) like upper('%$buscar%'))
            and c.tipoacceso=true and c.vigencia=false";
            break;
        case 3:
            $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
            where upper(c.usuario) like upper('%$buscar%') and c.tipoacceso=true and c.vigencia=false";
            break;
    };
    
    $result = $cnx->query($sql) or die;
    if($result->rowCount() != 0){
        while($reg = $result->fetchObject()){
    ?>
            <tr>    
                <td><?=$reg->idcliente?></td>
                <td><?=$reg->nombre?></td>
                <td><?=$reg->apellido?></td>
                <td><?=$reg->dni?></td>
                <td><?=$reg->nivel?></td>
                <td><?=$reg->usuario?></td>
                <td>No disponible</td> 
            </tr>    
    <?php
        }
    }
    else{
    ?>
        <!-- aqui va html -->

    <?php
    }