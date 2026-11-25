<?php


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

    // O JSON traz o id e o novo link do exemplo
    $dados = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("UPDATE jogos SET exemplo = ? WHERE id = ?");
    $stmt->execute([$dados["exemplo"], $dados["id"]]);

    echo json_encode(["mensagem" => "Link atualizado com sucesso!"]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar o Exemplo."]);
}
