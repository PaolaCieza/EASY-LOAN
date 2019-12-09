<?php
require_once("conexion.php");
if(!empty($_POST)){
    session_start();
    $idcliente = $_SESSION['idusuario'];
    $sexo = $_POST['sexo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $mantenerFoto = $_POST['mantenerFoto'];
    if ($sexo == 'femenino') {
        $sexo = 'false';
    } else{
        $sexo = 'true';
    }
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
        
        if($img != ""){
            $destino = "../recursos/perfiles/";
            $titulo_img = "img_".md5(date('d-m-Y H:m:s'));
            $img = $titulo_img.".".$tipo_img;
            $src = $destino.$img;
             
            $sql="UPDATE public.cliente SET sexo=$sexo, email='$correo', usuario='$usuario', fotousuario='$img' WHERE idcliente=$idcliente;";
            if($cnx->query($sql)){
                move_uploaded_file($url_img,$src);
                $_SESSION['foto'] = $img;
                $_SESSION['usuario'] = $usuario;
                echo 1;
            }
            else{
                echo 0;
            } 
        }
        
    }
    else{
        if($mantenerFoto == "false"){
            $sql="UPDATE public.cliente SET  sexo=$sexo, email='$correo', usuario='$usuario', fotousuario='user.png' WHERE idcliente=$idcliente;";
            if($cnx->query($sql)){
                $_SESSION['foto'] = "user.png";
                $_SESSION['usuario'] = $usuario;
                echo 1;
            }
            else{
                echo 0;
            } 
        }
        else{
            $sql="UPDATE public.cliente SET  sexo=$sexo, email='$correo', usuario='$usuario' WHERE idcliente=$idcliente;";
            if($cnx->query($sql)){
                echo 1;
                $_SESSION['usuario'] = $usuario;
            }
            else{
                echo 0;
            } 
        }
        
    }
    //$img_libro = "libro.jpg";
    
    
}
else{
    echo 0;
}
?>