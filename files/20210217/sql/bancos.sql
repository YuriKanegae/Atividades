create database portalNews;
use portalNews;

create table usuario(
    cpf varchar(11),
    email varchar(100),
    nome varchar(100),
    senha varchar(32),
    data_assinatura date,
    primary key (cpf, email)
);

create table administrador(
    id_administrador int auto_increment,
    nome varchar(100),
    email varchar(100),
    senha varchar(32),
    permissao varchar(10),
    primary key(id_administrador)
);

insert into administrador (nome, email, senha, permissao) values
    ('Administrador 1', 'adm_1@mail.com', 'e00cf25ad42683b3df678c61f42c6bda', 'baixa'),
    ('Administrador 2', 'adm_2@mail.com', 'c84258e9c39059a89ab77d846ddab909', 'alta');
