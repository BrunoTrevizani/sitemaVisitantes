<?php
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha]);

        // redireciona para mostrar a mensagem de sucesso
        header("Location: ../views/registro_usuarios.php?sucesso=1");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao criar conta: " . $e->getMessage();
    }
}
