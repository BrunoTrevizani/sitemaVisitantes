<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Visitante</title>
    <link rel="stylesheet" href="../style/registro_visitantes.css">
</head>
<body>
    <header>
        <h1>Registro de Visitante</h1>
    </header>

    <div class="container">
        <form action="../api/visitantes.php" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>

            <label for="empresa">Empresa:</label><br>
            <input type="text" id="empresa" name="empresa"><br><br>

            <label for="contato">Contato:</label><br>
            <input type="text" id="contato" name="contato"><br><br>

            <button type="submit" class="btn">Salvar Visitante</button>
        </form>

        <a href="../index.php">⬅ Voltar ao início</a>
    </div>
</body>
</html>
