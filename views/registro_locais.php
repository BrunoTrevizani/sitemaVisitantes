<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Local</title>
    <link rel="stylesheet" href="../style/registro_locais.css">
</head>
<body>
    <header>
        <h1>Registro de Local</h1>
    </header>

    <main>
        <div class="form-container">
            <form action="../api/locais.php" method="POST">
                <label for="nome">Nome do Local:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="descricao">Andar:</label>
                <select id="descricao" name="descricao" required>
                    <option value="">Selecione...</option>
                    <option value="Subsolo">Subsolo</option>
                    <option value="Térreo">Térreo</option>
                    <option value="1º Andar">1º Andar</option>
                    <option value="2º Andar">2º Andar</option>
                    <option value="3º Andar">3º Andar</option>
                    <option value="4º Andar">4º Andar</option>
                </select>

                <button type="submit">Salvar Local</button>
            </form>

            <?php if (isset($_GET['success'])): ?>
                <p class="success">Local registrado com sucesso!</p>
            <?php elseif (isset($_GET['error'])): ?>
                <p class="error">Erro ao registrar local!</p>
            <?php endif; ?>

            <a href="../index_admin.php" class="voltar">← Voltar ao início</a>
        </div>
    </main>
</body>
</html>