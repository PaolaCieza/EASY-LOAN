<?php
// PDO PHP Data Object
$driver = "pgsql"; //pgsql
$servidor = "localhost";
$basedatos = "DB_EASYLOAN";
$puerto = "5432";
$usuario = "postgres";
$clave 	 = "lujan";
$cadena = "$driver:host=$servidor;port=$puerto;dbname=$basedatos";
$cnx = new PDO($cadena,$usuario,$clave);
?>


