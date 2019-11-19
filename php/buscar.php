<?php
require_once("conexion.php");
$nombre = $_POST["letras"];
$sql = "SELECT * FROM `producto` WHERE nombre like '$nombre%'";
$result = $cnx ->query($sql);

while($reg = $result->fetchObject()){
	echo "<tr>
	<td>$reg->idproducto</td>
	<td>$reg->nombre</td>
	<td>$reg->autor</td>
	<td>$reg->portada</td>
	<td>$reg->descripcion</td>
	<td>$reg->usuario</td>
			<td>
				<button type='button'   data-toggle='modal' data-target='#divfrm'  class='btn btn-info' onclick='editar($reg->idproducto)'>Editar</button>
				<button type='button' class='btn btn-danger' onclick='eliminar($reg->idproducto)'>Eliminar</button>
			</td>
		</tr>";
}
?>