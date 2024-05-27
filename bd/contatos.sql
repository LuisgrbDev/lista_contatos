CREATE TABLE IF NOT EXISTS 	usuario(
	id int auto_increment primary key,
    nome varchar(100) not null,
    senha varchar (100),
    email varchar (100) unique,
    token varchar (255) default null
);