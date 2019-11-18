<?php
// PDO PHP Data Object
$driver = "pgsql"; //pgsql
$servidor = "192.168.1.38";
$basedatos = "BD_easyloan";
$puerto = "5454";
$usuario = "postgres";
$clave 	 = "123456789";
$cadena = "$driver:host=$servidor;port=$puerto;dbname=$basedatos";
$cnx = new PDO($cadena,$usuario,$clave);
?>


