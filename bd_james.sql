create database dbJames;

use dbJames;	

create table tblFaleConosco (
	idFaleConosco int(11) not null auto_increment primary key,
	nome varchar(200) not null,
    telefone varchar(24) not null,
    celular varchar(24) not null,
    email varchar(200) not null,
    homePage varchar(200),
    linkFacebook varchar(200),
    profissao varchar(100),
    intuito char(1) not null,
    mensagem text not null,
    genero char(1) not null
);

select * from tblFaleConosco;

insert into tblFaleConosco (
	nome, telefone, celular, email, homePage,
    linkFacebook, profissao, intuito, mensagem, genero
)
values (
	"José", "11 6666-6666", "11 96666-6666", "josesilva@gmail.com", "josedasilva.com.br",
    "facebook.com/jose_silva", "Engenheiro", "s",
    "Não sei", "m"
);

create table tblNivelAcesso (
	idNivelAcesso int(11) not null auto_increment primary key,
    nomeNivel varchar(200) not null,
    acessoConteudo boolean not null,
    acessoFaleConosco boolean not null,
    acessoProduto boolean not null,
    acessoUsuarios boolean not null
);

create table tblUsuario (
	idUsuario int(11) not null auto_increment primary key,
    nome varchar(200) not null,
    login varchar(200) not null,
    senha varchar(100) not null,
    idNivelAcesso int(11) not null,
    constraint FK_idNivelAcesso_tblUsuario foreign key (idNivelAcesso)
    references tblNivelAcesso (idNivelAcesso)
);

insert into tblNivelAcesso (
	nomeNivel, acessoConteudo, acessoFaleConosco, acessoProduto, acessoUsuarios)
    values (
		'Nivel de Administrador', '1', '1', '1', '1');

insert into tblNivelAcesso (
	nomeNivel, acessoConteudo, acessoFaleConosco, acessoProduto, acessoUsuarios)
    values (
		'Nivel cliente', '1', '0', '0', '0');

select * from tblNivelAcesso;

insert into tblUsuario (
	nome, login, senha, idNivelAcesso) 
    values (
		'Admin', 'admin', '123', '1');

insert into tblUsuario (
	nome, login, senha, idNivelAcesso) 
    values (
		'Cliente', 'cliente', '123', '2');

create table tblConteudo (
	idConteudo int(11) not null auto_increment primary key,
    titulo varchar(200),
    imagem varchar(200),
    texto text not null,
    visibilidade boolean not null,
    destino char(1) not null
);

select * from tblConteudo;

insert into tblConteudo ( titulo, imagem, texto, visibilidade, destino )
	values ( 'Titulo de teste', '675f0c0becfab4cf5743cd296c93dc89.png', 'Texto de teste, sim', 1, 'c' );
    
update tblConteudo set imagem = '675f0c0becfab4cf5743cd296c93dc89.png' where idConteudo = 1;

update tblConteudo set visibilidade = 0 where idConteudo = 6;

create table tblLoja(
	idLoja int(11) not null auto_increment primary key,
    nomeLoja varchar(200) not null,
    enderecoLoja varchar(200) not null,
    fotoLoja varchar(200) not null,
    textoLoja text not null,
    visibilidade boolean not null
);

insert into tblLoja (
		nomeLoja, enderecoLoja, fotoLoja, textoLoja, visibilidade
	)
    values (
		'Rua teste', 'Rua tal', '675f0c0becfab4cf5743cd296c93dc89.jpg', 'Texto rua tal', 1
    );

select tblUsuario.*, tblNivelAcesso.*
	from tblUsuario, tblNivelAcesso
    where tblUsuario.login = 'cliente'
	and tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso;
    
select tblUsuario.*, tblNivelAcesso.*
	from tblUsuario, tblNivelAcesso
    where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso;