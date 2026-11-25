<?php
// UPDATE - atualiza um jogo pelo id (verbo PUT)

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

try {
    require "conexao.php";

    // O JSON traz o id e os novos valores
    $dados = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("UPDATE jogos SET nome = ?, descricao = ? WHERE id = ?");
    $stmt->execute([$dados["nome"], $dados["descricao"], $dados["id"]]);

    echo json_encode(["mensagem" => "Jogo atualizado com sucesso!"]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar o jogo."]);
}
