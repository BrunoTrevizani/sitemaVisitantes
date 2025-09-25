<?php
session_start();
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    try {
        $pdo = getPDO();
        // busca no banco de usuários (funcionários que acessam o sistema)
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ? OR nome = ?");
        $stmt->execute([$login, $login]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: ../login.php?erro=1");
                exit();
            }
        } else {
            header("Location: ../login.php?erro=1");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro no login: " . $e->getMessage();
    }
}