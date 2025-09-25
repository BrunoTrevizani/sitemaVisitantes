<?php
session_start();
require_once __DIR__ . "/../db.php";

// Se não estiver logado, redireciona
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

$pdo = getPDO();

// Função para inserir local
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    if (!empty($nome) && !empty($descricao)) {
        $stmt = $pdo->prepare("INSERT INTO locais (nome, descricao) VALUES (:nome, :descricao)");
        if ($stmt->execute([':nome' => $nome, ':descricao' => $descricao])) {
            header("Location: ../views/registro_locais.php?success=1");
            exit();
        } else {
            header("Location: ../views/registro_locais.php?error=1");
            exit();
        }
    }
}

// Função para listar locais em JSON (caso chame via GET / api)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['action'])) {
    $stmt = $pdo->query("SELECT * FROM locais ORDER BY id DESC");
    $locais = $stmt->fetchAll();
    echo json_encode($locais);
    exit();
}