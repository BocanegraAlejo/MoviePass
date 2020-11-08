create DATABASE if not exists moviepass;
use moviepass;

CREATE TABLE if not exists usuarios (
    id_usuario int(10) NOT NULL AUTO_INCREMENT,
    email varchar(50),
    clave varchar(50),
    admin int(2),
    constraint `PK-id_usuario` primary key(id_usuario)
);
CREATE TABLE if not exists cine (
	id_cine int(5) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    direccion varchar(50),
    horario_apertura time,
    horario_cierre time,
    valor_entrada float(10),
    constraint `PK-id_cine` PRIMARY KEY(id_cine)
);
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE cine 
ADD constraint `FK-id_usuario` FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario);

CREATE TABLE if not exists genero (
	id_genero int(5) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    constraint `PK-id_genero` PRIMARY KEY(id_genero)
);

CREATE TABLE if not exists lenguaje (
	id_lenguaje varchar(10) NOT NULL,
    nombre varchar(50),
    constraint `PK-id_lenguaje` PRIMARY KEY(id_lenguaje) 
);

CREATE TABLE if not exists pelicula (
	id_pelicula int(5) NOT NULL,
    titulo varchar(50),
    descripcion varchar(150),
    duracion time,
    imagen varchar(50),
    fecha_lanzamiento date,
    constraint `PK-id_pelicula` PRIMARY KEY(id_pelicula)
);
drop table pelicula
CREATE TABLE if not exists sala (
	id_sala int(5) NOT NULL AUTO_INCREMENT,
    id_cine int(5),
    nombre_sala varchar(50),
    capacidad int(5),
    constraint `PK-id_sala` PRIMARY KEY(id_sala),
    constraint `FK-id_cine` foreign key(id_cine) references cine(id_cine) on DELETE CASCADE
);

CREATE TABLE if not exists funcion (
	id_funcion int(5) NOT NULL AUTO_INCREMENT,
    id_sala int(5),
    id_lenguaje varchar(10),
    id_pelicula int(5),
    horaYdia datetime,
	constraint `PK-id_funcion` PRIMARY KEY(id_funcion),
    constraint `FK-id_salaFuncion` FOREIGN KEY(id_sala) references sala(id_sala) on DELETE CASCADE,
    constraint `FK-id_lenguaje` FOREIGN KEY(id_lenguaje) references lenguaje(id_lenguaje),
    constraint `FK-id_pelicula` FOREIGN KEY(id_pelicula) references pelicula(id_pelicula) 
);
drop table funcion

CREATE TABLE if not exists genero_x_pelicula (
	id_gxp int(5) NOT NULL auto_increment,
    id_genero int(5),
    id_pelicula int(5),
    constraint `PK-id_gxp` PRIMARY KEY(id_gxp),
    constraint `FK-idgenero` FOREIGN KEY(id_genero) references genero(id_genero),
    constraint `FK-idpelicula` FOREIGN KEY(id_pelicula) references pelicula(id_pelicula)
); 

CREATE TABLE if not exists lenguaje_x_pelicula (
	id_lxp int(5) NOT NULL auto_increment,
    id_lenguaje varchar(10),
    id_pelicula int(5),
    constraint `PK-id-lxp` PRIMARY KEY(id_lxp),
    constraint `FK-id-lenguaje` FOREIGN KEY(id_lenguaje) references lenguaje(id_lenguaje),
    constraint `FK-id-pelicula` FOREIGN KEY(id_pelicula) references pelicula(id_pelicula)
);
drop table lenguaje_x_pelicula;


CREATE TABLE if not exists butacas_ocupadas (
	id_butaca int(5) NOT NULL auto_increment,
    id_funcion int(5),
    fila int(5),
    columna int(5),
    constraint `PK-id_butaca` PRIMARY KEY(id_butaca),
    constraint `FK-id_funcion` FOREIGN KEY(id_funcion) references funcion(id_funcion)
);
CREATE TABLE if not exists compra (
	id_compra int(5) NOT NULL auto_increment,
    id_usuario int(5),
    cantidad int(5),
    descuento int(5),
    total float,
    dia_y_hora timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    constraint `PK-id_compra` PRIMARY KEY(id_compra),
    constraint `FK-id_usuarioo` FOREIGN KEY(id_usuario) references usuarios(id_usuario)
);
drop table compra
CREATE TABLE if not exists entrada (
	id_entrada int(5) NOT NULL auto_increment,
    id_compra int(5),
    id_funcion int(5),
    qr_code varchar(200),
    constraint `PK-id_entrada` PRIMARY KEY(id_entrada),
    constraint `FK-id_compraa` FOREIGN KEY(id_compra) references compra(id_compra),
    constraint `FK-id_funcionn` FOREIGN KEY(id_funcion) references funcion(id_funcion)
);

SELECT p.titulo as `Pelicula`,(s.cant_filas*s.cant_columnas) as `capacidad_Maxima`
from funcion f
INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
INNER JOIN sala s ON f.id_sala=s.id_sala
INNER JOIN cine c ON s.id_cine=c.id_cine
INNER JOIN entrada e ON f.id_funcion=e.id_funcion
WHERE c.id_cine=55 GROUP BY 




		