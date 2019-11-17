CREATE TABLE NIVEL(
	IDNIVEL 			INT				NOT NULL		PRIMARY KEY,  --NIVELES DEL 1 AL 5 (0 A 1500 SOLES)
	NOMBRE		VARCHAR(20)		NOT NULL		UNIQUE,
	DESCRIPCION VARCHAR(200)	NOT NULL,
	MONTO_MAX	MONEY			NOT NULL,
	IMAGEN		VARCHAR(100) 	NOT NULL
);

CREATE TABLE CLIENTE(
	IDCLIENTE 			INT 							NOT NULL 		PRIMARY KEY,
	NOMBRE 		VARCHAR(50) 					NOT NULL,
	APELLIDO 	VARCHAR(50) 					NOT NULL,
	DNI 		CHAR(8) 						NOT NULL,
	FECHANAC 	DATE 							NOT NULL,
	SEXO 		BOOLEAN							NOT NULL, 		--- MASUCULINO = TRUE , FEMENINO = FALSE
	EMAIL 		VARCHAR(100) 					NOT NULL,
	USUARIO 	VARCHAR(20) 					NOT NULL 		UNIQUE,
	CLAVE 		CHAR(32) 						NOT NULL,
	IDNIVEL 	INT 			DEFAULT 1		NOT NULL 		REFERENCES NIVEL,
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
	estado 				boolean 		null, -- true hay solicitud false fue cancelada
	monto 				money 			not null,
	periodo				boolean			not null, --true mensual, false semanal
	vencimiento			timestamp		default (current_timestamp::timestamp + (5||'day')::interval)::timestamp
);

create table respuesta(
	idRespuesta 		int 			primary key,
	idSolicitud 		int 			not null 				references solicitud,
	idCliente 			int 			not null 				references cliente,
	fecha 				date 			default current_date 	not null,
	hora				time			default current_time	not null,
	tasaInteres 		numeric(8,2) 	not null,
	--interes_empresa 	numeric(8,2) 	 null,
	estado 				boolean 		null --true=vigente, false=cancelada, si el cliente acepta otra resp tu resp se pondrá en 
);												-- false si tú deseas retirar la respuesta pones cancelar y se cambia el estado de la resp

create table prestamo(
	idPrestamo 			int 			primary key,
	idRespuesta 		int 			not null 				references respuesta,
	estado 				boolean 		default false 			not null,  -- true pagado false deuda
	fecha 				date 			default current_date 	not null,
	hora				time			default current_time	not null,
	monto 				numeric(8,2) 	not null,
	tasaInteres			numeric(8,2)		not null,
	numeroCuotas 		int 			not null,
	periodo				boolean			not null
);

create table cuota(
	idCuota				int 			primary key,
	idPrestamo 			int 			not null 				references prestamo,
	numeroCuota 		int 			not null,
	montoCuota			numeric(8,2)	not null,
	montoMora			numeric(8,2)	not null,
	fechaVencimiento 	date 			not null,
	--montoTotal			numeric(8,2)	null,
	estado 				boolean			default false			not null -- true pagado, false sin pagar  
);

/*create table pago(
	idPago				numeric(8,2)	primary key,
	idCuota				int				not null,
	fecha				date 			DEFAULT current_date	not null,
	hora 				time 			default current_time	not null,
	monto 				numeric(8,2)	not null
	--noseeeeeeeeeeeeeeeee
);


select * from prestamo
select * from cliente
select prestamo.idprestamo,cliente.nombre,cliente.apellido as prestamista,prestamo.estado, prestamo.fecha,prestamo.montofinal, 
prestamo.numerocuotas 
from prestamo inner join respuesta on respuesta.idrespuesta = prestamo.idrespuesta
inner join cliente on cliente.id = respuesta.idcliente where cliente.usuario = 'paolacieza09' order by 1;

SELECT * FROM NIVEL
*/


create or replace function fn_generar_cuotas() returns trigger as
$$
	declare
		monto numeric(14,2);
		num int = 1;	
	begin
		monto = ((new.monto * new.tasainteres) / (1 - power((1 + new.tasainteres),(-new.numerocuotas))));
		IF(new.periodo = true) THEN
			FOR num in 1..new.numerocuotas
				LOOP
				INSERT INTO public.cuota(
				idcuota, idprestamo, numerocuota, montocuota, montomora, fechavencimiento, estado)
				VALUES ((select coalesce(max(idcuota),0)+1 from cuota), new.idprestamo, num, monto, null, 
						(current_date::date + (num||' month')::interval), false);
				num = num +1;
			 END LOOP;
		ELSE
			FOR num in 1..new.numerocuotas
				LOOP
				INSERT INTO public.cuota(
				idcuota, idprestamo, numerocuota, montocuota, montomora, fechavencimiento, estado)
				VALUES ((select coalesce(max(idcuota),0)+1 from cuota), new.idprestamo, num, monto, null, 
						(current_date::date + (num||' week')::interval), false);
				num = num +1;
			 END LOOP;
		END IF;
		 return new;
	end

$$ language 'plpgsql';
Create trigger tr_generar_cuotas after insert on prestamo
for each row execute procedure fn_generar_cuotas();
--------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_pagar_prestamo() RETURNS TRIGGER AS
$$
DECLARE
	total int;
	pagado int;

BEGIN
			SELECT numeroCuotas INTO total FROM prestamo WHERE idPrestamo = OLD.idPrestamo;
			SELECT COUNT(*) INTO pagado FROM cuota WHERE estado = true and idPrestamo = OLD.idPrestamo;
			IF(total = pagado) THEN
				UPDATE public.prestamo SET estado=TRUE WHERE idPrestamo = NEW.idPrestamo;
			ELSE
				UPDATE public.prestamo SET estado=FALSE WHERE idPrestamo = NEW.idPrestamo;
			END IF;
			RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER tg_pagar_prestamo AFTER UPDATE ON cuota FOR EACH ROW EXECUTE PROCEDURE fn_pagar_prestamo();
---------------------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_aceptar_solicitud() RETURNS TRIGGER AS
$$
DECLARE

BEGIN
	if((SELECT COUNT(*) FROM respuesta WHERE idsolicitud=NEW.idsolicitud and estado = true)=0) THEN
		UPDATE public.solicitud SET estado = true where idsolicitud = NEW.idsolicitud;	
	END IF;
	RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER tg_aceptar_solicitud AFTER INSERT ON respuesta FOR EACH ROW EXECUTE PROCEDURE fn_aceptar_solicitud();
-----------------------------------------------------------------------------------------------------------------------------
select * from cliente
select * from respuesta
select * from solicitud
select * from prestamo
select * from cuota
SELECT round(46.5)
--------------------------------------------------------------------------------------------------------------------------------------
select p.idprestamo, c.nombre ||' '||c.apellido as prestamista,p.monto, p.numerocuotas, 
(case when p.estado=true then 'Pagado' else 'Pendiente' end) as estado, p.fecha
from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta 
inner join solicitud s on r.idsolicitud=s.idsolicitud
inner join cliente c on r.idcliente=c.idcliente
where s.idCliente=1 offset 0  limit 3


select c.nombre ||' '||c.apellido as prestamista, r.tasainteres*100, c.fotousuario from respuesta r inner join cliente c
on c.idcliente=r.idcliente where r.idsolicitud = 1



----------------------------
select c.nombre as usuario, n.idnivel, n.nombre, n.descripcion,n.imagen 
from cliente c inner join nivel n on n.idnivel=c.idnivel where c.idcliente=1


