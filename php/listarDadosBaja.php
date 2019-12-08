<?php       
    require_once("conexion.php");
    $sql="SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel 
    where c.tipoacceso=true and c.vigencia=false";
    $result = $cnx->query($sql);
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