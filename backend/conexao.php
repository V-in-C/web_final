<?php
// Conexão com o banco MySQL usando PDO.
// Este arquivo é incluído pelos outros arquivos PHP.

$host    = "localhost";
$banco   = "jogos_mesa";
$usuario = "root";
$senha   = "";   // no XAMPP a senha do root normalmente é vazia

$pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);

// Faz o PDO lançar exceção quando der erro (para cair no catch)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
