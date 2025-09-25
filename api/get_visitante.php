<?php
require_once("../db.php");
$pdo = getPDO();

$cpf = $_GET['cpf'] ?? '';

if ($cpf) {
    $stmt = $pdo->prepare("SELECT id, name FROM visitantes WHERE cpf = ?");
    $stmt->execute([$cpf]);
    $visitante = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($visitante) {
        echo json_encode([
            "found" => true,
            "id"    => $visitante['id'],
            "nome"  => $visitante['name'] 
        ]);
    } else {
        echo json_encode(["found" => false]);
    }
}