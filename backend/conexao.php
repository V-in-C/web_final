<?php


$host    = "localhost";
$banco   = "jogos_mesa";
$usuario = "root";
$senha   = "";

$pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
