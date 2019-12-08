<?php
require_once("conexion.php");
if(!empty($_POST)){
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $montoMax = $_POST['montoMax'];
    
    //$nom_img = "";
    if(!empty($_FILES)){
        $img = $_FILES['imagen']; 
        $nom_img = $img['name'];
        $tipo_img = $img['type'];
        $url_img = $img['tmp_name'];
        $tam_img = $img['size'];     
        $error = $img['error']; 
        $tipo_img = explode("/",$tipo_img);
        $tipo_img = $tipo_img[1];   

        //$img_libro = "libro.jpg";
        $destino = "../recursos/niveles/";
        $titulo_img = "img_".md5(date('d-m-Y H:m:s'));
        $img = $titulo_img.".".$tipo_img;
        $src = $destino.$img;

        $sql="INSERT INTO public.nivel(
            idnivel, nombre, descripcion, montomax, imagen)
            VALUES ((select coalesce(max(idnivel),0)+1 from nivel), '$nombre', '$descripcion', $montoMax, '$img');";
        if($cnx->query($sql)){
            move_uploaded_file($url_img,$src);
            echo 1;
        }
        else{
            echo 0;
        }
    
    }
    else{
        echo 0;
    }
    
}
else{
    echo 0;
}
?>