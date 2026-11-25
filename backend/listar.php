<?php


// Cabeçalhos de CORS (frontend e backend rodam em portas diferentes)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

// Responde ao preflight e para aqui
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

try {
    require "conexao.php";

    $stmt = $pdo->prepare("SELECT id, nome, descricao, exemplo FROM jogos WHERE ativo = 1");
    $stmt->execute();
    $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($jogos);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro no listamento dos jogos."]);
}
