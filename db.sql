create DATABASE moviepass;
use moviepass;

CREATE TABLE usuarios (
    id_usuario int(10) NOT NULL AUTO_INCREMENT,
    email varchar(50),
    clave varchar(50),
    admin int(2),
    PRIMARY KEY(id_usuario)
);

insert into usuarios values('','martinmolina@gmail.com','ejemplo',0);