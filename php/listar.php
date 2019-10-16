<?php
session_start();
if (!isset($_SESSION['usuario'])){
	header('location: ../html/iniciarsesion.html');
} else {
	require_once("conexion.php");
	// $p = $_POST['pag'];
	$cant=10;
	// $inicio=($p-1)*$cant; $inicio,
	$columna = $_POST['columna'];
	$sql="SELECT * FROM producto   order by $columna LIMIT $cant";
	$result = $cnx->query($sql);
	
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
}
?>