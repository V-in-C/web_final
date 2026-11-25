<?php
// CREATE - cadastra um novo jogo (verbo POST)

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

try {
    require "conexao.php";

    // Lê o JSON enviado pelo fetch
    $dados = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("INSERT INTO jogos (nome, descricao, exemplo) VALUES (?, ?, ?)");
    $stmt->execute([$dados["nome"], $dados["descricao"], $dados["exemplo"]]);

    echo json_encode(["mensagem" => "Jogo cadastrado com sucesso!"]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao cadastrar o jogo."]);
}
