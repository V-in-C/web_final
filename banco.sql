-- Banco de dados
CREATE DATABASE IF NOT EXISTS jogos_mesa;
USE jogos_mesa;

CREATE TABLE jogos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    exemplo VARCHAR(500) NOT NULL DEFAULT '',
    ativo TINYINT NOT NULL DEFAULT 1 
);


INSERT INTO racas (nome, descricao) VALUES
('UNO', 'Todos recebem 7 cartas, no seu turno, descarte uma carta com o simbulo ou cor igual ao da mesa, se nao puder, compre mais uma carta. vence quem nao tem mais cartas'),
('D&D', 'Crie uma aventura RPG para seus amigos'),
('War', 'Jogo de gerra');
