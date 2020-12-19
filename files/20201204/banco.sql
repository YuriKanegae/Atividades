create database if not exists precos;
use precos;

create table nicho (
	id_nicho int auto_increment,
    nome varchar(100),
    primary key (id_nicho)
);

create table categoria(
	id_categoria int auto_increment,
    id_nicho int,
    nome varchar(100),
    primary key (id_categoria),
    foreign key (id_nicho) references nicho(id_nicho) ON DELETE CASCADE ON UPDATE CASCADE
);

create table produto(
	id_produto int auto_increment,
    id_categoria int,
    nome varchar (100),
 	primary key (id_produto),
    foreign key (id_categoria) references categoria(id_categoria)  ON DELETE CASCADE ON UPDATE CASCADE
);

create table precos(
	id_precos int auto_increment,
    id_produtos int,
    preco float,
    primary key (id_precos),
    foreign key (id_produtos) references produto(id_produto)  ON DELETE CASCADE ON UPDATE CASCADE
);

create table usuario(
	id_usuario int auto_increment,
	nome varchar(100),
	email varchar(300),
	senha varchar(32),
	primary key(id_usuario)
);