CREATE DATABASE webapp;
USE webapp;

CREATE TABLE imagens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    nome_original VARCHAR(255) NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    caminho VARCHAR(255) NOT NULL
);

CREATE TABLE usuarios(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome varchar(40) NOT NULL,
    email varchar(255) NOT NULL UNIQUE

);

CREATE TABLE usuariosImagens(
  usuarios_ID INT NOT NULL,
  images_ID INT NOT NULL,
  CONSTRAINT FK_GALERIA_IMAGEM Foreign KEY (images_ID) references imagens(id),
  CONSTRAINT FK_GALERIA_USUARIO Foreign KEY (usuarios_ID) references usuarios(id),

  CONSTRAINT PK_GALERIA_ID PRIMARY KEY (usuarios_ID, images_ID)
);