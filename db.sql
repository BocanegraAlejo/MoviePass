/*create DATABASE moviepass; */
use moviepass;

/**CREATE TABLE usuarios (
    id_usuario int(10) NOT NULL AUTO_INCREMENT,
    email varchar(50),
    clave varchar(50),
    admin int(2),
    PRIMARY KEY(id_usuario)
);*/
CREATE TABLE cine (
	id_cine int(10) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    direccion varchar(50),
    horario_apertura time,
    horario_cierre time,
    valor_entrada float(10),
    PRIMARY KEY(id_cine)
);
/*insert into usuarios values('','martinmolina@gmail.com','ejemplo',0); */

