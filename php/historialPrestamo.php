<?php
session_start();

require_once("conexion.php");
$usuario = $_SESSION['usuario'];
$sql="SELECT prestamo.idprestamo,cliente.nombre,cliente.apellido as prestamista,prestamo.estado, 
        prestamo.fecha,prestamo.montofinal, prestamo.numerocuotas 
        FROM prestamo inner join respuesta on respuesta.idrespuesta = prestamo.idrespuesta
        inner join cliente on cliente.id = respuesta.idcliente where cliente.usuario = '$usuario' order by 1;";
$result = $cnx->query($sql);

while($reg = $result->fetchObject()){
	echo "<tr>
			<td>$reg->idprestamo</td>
			<td>$reg->nombre</td>
			<td>$reg->prestamista</td>
			<td>$reg->estado</td>
			<td>$reg->fecha</td>
			<td>$reg->montofinal</td>
			<td>$reg->numerocuotas</td>
		</tr>";
}

?>