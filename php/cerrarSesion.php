<?php
        session_start();  
    	unset($_SESSION['idusuario']);
    	unset($_SESSION['usuario']);
    	unset($_SESSION['acceso']);
    	unset($_SESSION['foto']);
    	unset($_SESSION['nombre']);
		session_destroy();
		echo 1;