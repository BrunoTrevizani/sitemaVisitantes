<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="../style/registro_usuarios.css">
</head>
<body>
    <div class="container">
        <h2>Criar Conta</h2>

        <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
            <p class="sucesso">Conta criada com sucesso!</p>
            <a href="../index_admin.php" class="btn">Voltar ao Início</a>
        <?php else: ?>
            <form method="POST" action="../api/registro_usuarios.php">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>

                <button type="submit">Criar Conta</button>
                <a href="trocar_senha.php" class="btn">Trocar senha</a>
            </form>
            <br>
            <a href="../index_admin.php" class="voltar">← Voltar ao início</a>
        <?php endif; ?>
    </div>
</body>
</html>