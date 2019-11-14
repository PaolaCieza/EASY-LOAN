CREATE TABLE NIVEL(
	ID 			INT				NOT NULL		PRIMARY KEY,  --NIVELES DEL 1 AL 5 (0 A 1500 SOLES)
	NOMBRE		VARCHAR(20)		NOT NULL		UNIQUE,
	MONTO_MAX	MONEY			NOT NULL
);

CREATE TABLE CLIENTE(
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

INSERT INTO cliente
	VALUES (1, 'Jesús Fernando', 'Luján Piscoya', '75553596', '1998-08-04', true,'jesusfer_nan2@hotmail.com' ,
			'fernando10','fernando123', DEFAULT, DEFAULT);

SELECT * FROM cliente INNER JOIN NIVEL ON ID_NIVEL = NIVEL.ID

INSERT INTO public.usuario(
	id, nombre, apellido, dni, fecha_nac, sexo, email, usuario, clave, id_nivel, tipo, fotousuario)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);


-- codigo de php 
INSERT INTO cliente VALUES ((select coalesce(max(id),0)+1 from usuario), '$nombre', '$apellidos', '$dni',
							'$fecha', '$sexo', '$correo', '$usuario', '$contraseña', DEFAULT, DEFAULT, DEFAULT);
SELECT * FROM NIVEL


create table solicitud(
	idSolicitud 		int 			primary key,
	idCliente 			int 			not null 				references cliente,
	fecha 				date 			default current_date 	not null,
	hora				time			default current_time	not null,
	estado 				boolean 		not null, -- true hay solicitud false fue cancelada
	monto 				money 			not null,
	periodo				boolean			not null
);

create table respuesta(
	idRespuesta 		int 			primary key,
	idSolicitud 		int 			not null 				references solicitud,
	idCliente 			int 			not null 				references cliente,
	fecha 				date 			default current_date 	not null,
	hora				time			default current_time	not null,
	interes_cliente 	numeric(8,2) 	not null,
	interes_empresa 	numeric(8,2) 	not null,
	estado 				boolean 		not null --true=vigente, false=cancelada, si el cliente acepta otra resp tu resp se pondrá en 
);												-- false si tú deseas retirar la respuesta pones cancelar y se cambia el estado de la resp

create table prestamo(
	idPrestamo 			int 			primary key,
	idRespuesta 		int 			not null 				references respuesta,
	estado 				boolean 		not null,  -- true pagado false deuda
	fecha 				date 			default current_date 	not null,
	hora				time			not null,
	montoFinal 			numeric(8,2) 	not null,
	tasaMensual			numeric(8,2)	not null,
	numeroCuotas 		int 			not null
);

create table cuota(
	idCuota				int 			primary key,
	idPrestamo 			int 			not null 				references prestamo,
	numeroCuota 		int 			not null,
	montoCuota			numeric(8,2)	not null,
	montoMora			numeric(8,2)	not null,
	fechaVencimiento 	date 			not null,
	montoTotal			numeric(8,2)	null,
	estado 				boolean			not null -- true pagado, false sin pagar  
);

create table pago(
	idPago				numeric(8,2)	primary key,
	idCuota				int				not null,
	fecha				date 			DEFAULT current_date	not null,
	hora 				time 			default current_time	not null,
	monto 				numeric(8,2)	not null
	--noseeeeeeeeeeeeeeeee
);








