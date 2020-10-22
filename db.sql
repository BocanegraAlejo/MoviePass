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

CREATE TABLE if not exists genero_x_pelicula (
	id_genero int(5) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    constraint `PK-id_genero` PRIMARY KEY(id_genero)
);

CREATE TABLE if not exists lenguaje_x_pelicula (
	id_lenguaje int(5) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    constraint `PK-id_lenguaje` PRIMARY KEY(id_lenguaje)
);

CREATE TABLE if not exists pelicula (
	id_pelicula int(5) NOT NULL AUTO_INCREMENT,
    titulo varchar(50),
    descripcion varchar(150),
    id_genero int(5),
    duracion time,
    imagen varchar(50),
    id_lenguaje int(5),
    fecha_lanzamiento date,
    constraint `PK-id_pelicula` PRIMARY KEY(id_pelicula),
    constraint `FK-id_genero` foreign key(id_genero) references genero_x_pelicula(id_genero),
    constraint `FK-id_lenguaje` foreign key(id_lenguaje) references lenguaje_x_pelicula(id_lenguaje)
);
   
CREATE TABLE if not exists sala (
	id_sala int(5) NOT NULL AUTO_INCREMENT,
    id_cine int(5),
    nombre_sala varchar(50),
    capacidad int(5),
    constraint `PK-id_sala` PRIMARY KEY(id_sala),
    constraint `FK-id_cine` foreign key(id_cine) references cine(id_cine)
);

CREATE TABLE if not exists funcion (
	id_funcion int(5) NOT NULL AUTO_INCREMENT,
    id_cine int(5),
    id_sala int(5),
    id_pelicula int(5),
    horaYdia datetime,
	constraint `PK-id_funcion` PRIMARY KEY(id_funcion),
    constraint `FK-id_cineFuncion` FOREIGN KEY(id_cine) references cine(id_cine),
    constraint `FK-id_salaFuncion` FOREIGN KEY(id_sala) references sala(id_sala),
    constraint `FK-id_pelicula` FOREIGN KEY(id_pelicula) references pelicula(id_pelicula)
);

select p.titulo, lxp.nombre, p.duracion, f.horaYdia
from 


