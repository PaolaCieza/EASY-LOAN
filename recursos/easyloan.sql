CREATE TABLE NIVEL(
	IDNIVEL 	INT		NOT NULL		PRIMARY KEY,  --NIVELES DEL 1 AL 5 (0 A 1500 SOLES)
	NOMBRE		VARCHAR(20)		NOT NULL		UNIQUE,
	DESCRIPCION VARCHAR(200)	NOT NULL,
	MONTOMAX	NUMERIC (8,2)	NOT NULL,
	IMAGEN		VARCHAR(100) 	NOT NULL
);

CREATE TABLE CLIENTE(
	IDCLIENTE 			INT 					NOT NULL 		PRIMARY KEY,
	NOMBRE 		VARCHAR(50) 					NOT NULL,
	APELLIDO 	VARCHAR(50) 					NOT NULL,
	DNI 		CHAR(8) 						NOT NULL,
	FECHANAC 	DATE 							NOT NULL,
	SEXO 		BOOLEAN							NOT NULL, 		--- MASUCULINO = TRUE , FEMENINO = FALSE
	EMAIL 		VARCHAR(100) 					NOT NULL,
	TELEFONO	VARCHAR(8)						NULL,
	DIRECCION 	VARCHAR(200)					NULL,
	USUARIO 	VARCHAR(20) 					NOT NULL 		UNIQUE,
	CLAVE 		CHAR(32) 						NOT NULL,
	IDNIVEL 	INT 			DEFAULT 1		NULL 		REFERENCES NIVEL,
	TIPO 		BOOLEAN 		DEFAULT TRUE	NULL, 		--FALSE NORMALITO, TRUE PREMIUN
	VIGENCIA	BOOLEAN			DEFAULT TRUE	NOT NULL,
	FOTOUSUARIO VARCHAR(36)		DEFAULT 'user.jpg'	NULL,
	TIPOACCESO	BOOLEAN			DEFAULT	TRUE	NOT NULL --TRUE CLIENTE, FALSE ADMIN		
);

INSERT INTO NIVEL VALUES (1, 'BÁSICO', 'Permite realizar y solicitar prestamos de hasta S/25',25,'nivel1.png');
INSERT INTO NIVEL VALUES (2, 'MEDIO','Permite realizar y solicitar prestamos de hasta S/25', 25,'nivel2.png');
INSERT INTO NIVEL VALUES (3, 'INTERMEDIO','Permite realizar y solicitar prestamos de hasta S/25', 25,'nivel3.png');
INSERT INTO NIVEL VALUES (4, 'AVANZADO', 'Permite realizar y solicitar prestamos de hasta S/25',25,'nivel4.png');
INSERT INTO NIVEL VALUES (5, 'PRO','Permite realizar y solicitar prestamos de hasta S/25', 25,'nivel5.png');

INSERT INTO cliente
	VALUES (1, 'Jesús Fernando', 'Luján Piscoya', '75553596', '1998-08-04', true,'jesusfer_nan2@hotmail.com' ,
			'fernando10','fernando123', DEFAULT, DEFAULT);
INSERT INTO cliente
	VALUES (2, 'Paola E', 'Cieza Bances', '75756219', '1999-11-09', true,'paolita_thu_xikitah@gmail.com' ,
			'paola','123', DEFAULT, DEFAULT);

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
	numeroCuotas		int				not null,
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
	fechaRegistro 		date 			default current_date 	not null,
	hora				time			default current_time	not null,
	fechaPago			date									null,
	monto 				numeric(8,2) 	not null,
	tasaInteres			numeric(8,2)	not null,
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
	fechaPago			date			null,
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
				idcuota, idprestamo, numerocuota, montocuota, montomora, fechavencimiento, fechaPago, estado)
				VALUES ((select coalesce(max(idcuota),0)+1 from cuota), new.idprestamo, num, monto, 0, 
						(current_date::date + (num||' month')::interval), null, false);
				num = num +1;
			 END LOOP;
		ELSE
			FOR num in 1..new.numerocuotas
				LOOP
				INSERT INTO public.cuota(
				idcuota, idprestamo, numerocuota, montocuota, montomora, fechavencimiento, estado)
				VALUES ((select coalesce(max(idcuota),0)+1 from cuota), new.idprestamo, num, monto, 0, 
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
				UPDATE public.prestamo SET estado=TRUE,fechaPago=current_date WHERE idPrestamo = NEW.idPrestamo;
			ELSE
				UPDATE public.prestamo SET estado=FALSE,fechaPago=null WHERE idPrestamo = NEW.idPrestamo;
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
CREATE OR REPLACE FUNCTION fn_aceptar_respuesta(id integer) RETURNS BOOLEAN AS
$$
DECLARE
	sol integer;
	mont numeric;
	cuotas integer;
	inter numeric;
	per boolean;
BEGIN
	select r.idsolicitud,r.tasainteres into sol, inter from respuesta r where idrespuesta=id;
	select s.monto, s.numerocuotas,s.periodo into mont, cuotas, per from solicitud s where s.idsolicitud=sol; 
	UPDATE public.respuesta r SET estado=true WHERE r.idrespuesta=id;
	UPDATE public.respuesta r SET estado=false WHERE r.idsolicitud=sol and r.estado is null;
	INSERT INTO public.prestamo(
	idprestamo, idrespuesta, estado, fechaRegistro, hora, fechaPago, monto, tasainteres, numerocuotas, periodo)
	VALUES ((select coalesce(max(idprestamo),0)+1 from prestamo), id, DEFAULT, DEFAULT, DEFAULT, null, mont, inter, cuotas, per);
	return true;
	exception
		when others then return false;
END;
$$ LANGUAGE 'plpgsql';

-----------------------------------------------------------------------------------------------------------------------------
select fn_aceptar_respuesta(5)

SELECT round(46.5)
--------------------------------------------------------------------------------------------------------------------------------------
select p.idprestamo, c.nombre ||' '||c.apellido as prestamista,p.monto, p.numerocuotas, 
(case when p.estado=true then 'Pagado' else 'Pendiente' end) as estado, p.fecha
from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta 
inner join solicitud s on r.idsolicitud=s.idsolicitud
inner join cliente c on r.idcliente=c.idcliente
where s.idCliente=1 offset 0  limit 3


SELECT r.idrespuesta, c.nombre ||' '||c.apellido as prestamista, r.tasainteres*100 as interes, c.fotousuario,
s.numerocuotas, (case when s.periodo=true then 'MENSUALES' else 'SEANALES' end) as periodo
from respuesta r inner join cliente c
on c.idcliente=r.idcliente inner join solicitud s on r.idsolicitud=s.idsolicitud
where r.idsolicitud = (select idsolicitud from solicitud where estado=true and idcliente = 1 order by 1 desc limit 1 )
and r.estado is null


select * from solicitud s inner join respuesta r on r.idsolicitud = s.idsolicitud where r.estado is null
----------------------------
select c.nombre as usuario, n.idnivel, n.nombre, n.descripcion,n.imagen 
from cliente c inner join nivel n on n.idnivel=c.idnivel where c.idcliente=1
select version();
---------------------------------------------------------------------------------------------------------------------
select * from cliente
select * from respuesta
select * from solicitud
select * from prestamo
select * from cuota
---------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_validar_solicitud(idC integer) RETURNS BOOLEAN AS
$$
DECLARE
	prest integer; --0
	solc integer; --0
	resp integer; --0
BEGIN
	select count(*) into prest from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta inner join 
	solicitud s on s.idsolicitud=r.idsolicitud where s.idcliente=idC and p.estado=false;   
	select count(*) into solc from solicitud s where estado is null and s.idcliente=idC;
	select count(*) into resp from solicitud s inner join respuesta r on r.idsolicitud=s.idsolicitud
	where r.estado is null and s.idcliente=idC;
	if(prest=0 and solc=0 and resp=0)then
		return true;		
	else
		return false;
	end if;
END;
$$ LANGUAGE 'plpgsql';


select fn_validar_solicitud(1);

select * from solicitud
select * from prestamo

SELECT montomax from cliente c inner join nivel n on c.idnivel=n.idnivel where c.idcliente=1

select numerocuota, montocuota, fechavencimiento,(case when estado=true then 'PAGADO' else 'PENDIENTE' end) 
from cuota c where c.idprestamo=1

select * from cliente where idCliente=2
SELECT *,(case when tipoacceso=true then 'cliente'  else 'admin' end) as acceso FROM cliente where usuario = 'fernando10' and clave = 'fernando123' and vigencia=true

select count(*) as prestatario from prestamo p inner join respuesta r on r.idrespuesta=p.idrespuesta 
inner join solicitud s on s.idsolicitud=r.idsolicitud where s.idcliente=1

select count(*) from respuesta where estado=true and idcliente=2

SELECT c.*,n.nombre as nivel from cliente c inner join nivel n on c.idnivel=n.idnivel  
where upper(c.nombre) like upper('%CIE%') or upper(c.apellido) like upper('%CIE%')
select * from nivel

SELECT (case when telefono is null then 'No registrado' else telefono end)  FROM cliente 


select * from cuota
