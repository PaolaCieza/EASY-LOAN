<?php
require_once("conexion.php");
$id = $_POST["idproducto"];
$nombre = $_POST["txtnombres"];
$autor = $_POST["txtcantidad"];
$portada = $_POST["txtcolor"];
$descripcion = $_POST["txtdescripcion"];
$usuario = $_POST["txtusuario"];

if ($id == '') {
    $sql="insert into producto values (default,'$nombre', '$autor','$portada','$descripcion','$usuario')";
} else{
    $sql = "UPDATE producto SET nombre='$nombre',autor='$autor',portada='$portada',descripcion='$descripcion',usuario='$usuario' WHERE idproducto = '$id'";
}

$cnx ->query($sql);

header("location:  ../index.html")

?>