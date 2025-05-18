-- Criação do banco de dados
CREATE DATABASE gestaoepi_bd;
USE gestaoepi_bd;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTOINCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso ENUM('admin', 'usuario') NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de campos (exemplo para "Cadastro de novos campos")
CREATE TABLE campos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_campo VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de logs (opcional, para rastrear atividades)
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    acao VARCHAR(255) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Inserção de um usuário administrador padrão
INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES
('Administrador', 'admin@empresa.com', MD5('admin123'), 'admin');