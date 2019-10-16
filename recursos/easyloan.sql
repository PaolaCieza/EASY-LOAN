CREATE TABLE NIVEL(
	ID 			INT				NOT NULL		PRIMARY KEY,  --NIVELES DEL 1 AL 5 (0 A 1500 SOLES)
	NOMBRE		VARCHAR(20)		NOT NULL		UNIQUE,
	MONTO_MAX	MONEY			NOT NULL
);

CREATE TABLE USUARIO(
	ID 			INT 							NOT NULL 		PRIMARY KEY,
	NOMBRE 		VARCHAR(50) 					NOT NULL,
	APELLIDO 	VARCHAR(50) 					NOT NULL,
	DNI 		CHAR(8) 						NOT NULL,
	FECHA_NAC 	DATE 							NOT NULL,
	SEXO 		BOOLEAN							NOT NULL, 		--- MASUCULINO = TRUE , FEMENINO = FALSE
	EMAIL 		VARCHAR(100) 					NOT NULL,
	USUARIO 	VARCHAR(20) 					NOT NULL 		UNIQUE,
	CLAVE 		CHAR(32) 						NOT NULL,
	ID_NIVEL 	INT 			DEFAULT 1		NOT NULL 		REFERENCES NIVEL,
	TIPO 		BOOLEAN 		DEFAULT TRUE	NOT NULL, 		--FALSE NORMALITO, TRUE PREMIUN
	FOTOUSUARIO VARCHAR(36)		DEFAULT 'user.jpg'	NOT	NULL
);

INSERT INTO NIVEL VALUES (1, 'BÁSICO', 25);
INSERT INTO NIVEL VALUES (2, 'MEDIO', 25);
INSERT INTO NIVEL VALUES (3, 'INTERMEDIO', 25);
INSERT INTO NIVEL VALUES (4, 'AVANZADO', 25);
INSERT INTO NIVEL VALUES (5, 'PRO', 25);

INSERT INTO usuario
	VALUES (1, 'Jesús Fernando', 'Luján Piscoya', '75553596', '1998-08-04', true,'jesusfer_nan2@hotmail.com' ,
			'fernando10','fernando123', DEFAULT, DEFAULT);

SELECT * FROM usuario INNER JOIN NIVEL ON ID_NIVEL = NIVEL.ID

INSERT INTO public.usuario(
	id, nombre, apellido, dni, fecha_nac, sexo, email, usuario, clave, id_nivel, tipo, fotousuario)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);


-- codigo de php 
INSERT INTO usuario VALUES ((select coalesce(max(id),0)+1 from usuario), '$nombre', '$apellidos', '$dni',
							'$fecha', '$sexo', '$correo', '$usuario', '$contraseña', DEFAULT, DEFAULT, DEFAULT);

delete  from usuario where id = 2;




