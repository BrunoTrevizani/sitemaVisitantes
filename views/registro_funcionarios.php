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
    <title>Registro de Funcionário</title>
    <link rel="stylesheet" href="../style/registro_visitantes.css">
</head>
<body>
    <header>
        <h1>Registro de Funcionário</h1>
    </header>

    <div class="container">
        <form action="../api/funcionarios.php" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>

            <label for="cargo">Cargo:</label><br>
            <input type="text" id="cargo" name="cargo" required><br><br>

            <label for="setor">Setor:</label><br>
            <input type="text" id="setor" name="setor" required><br><br>

            <label for="telefone">Telefone:</label><br>
            <input type="text" id="telefone" name="telefone"><br><br>

            <button type="submit" class="btn">Salvar Funcionário</button>
            

        </form>

        <a href="../index_admin.php">⬅ Voltar ao início</a>
    </div>
</body>
</html>