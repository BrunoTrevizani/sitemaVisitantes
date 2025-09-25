<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
date_default_timezone_set('America/Sao_Paulo');

// Criar conexão para buscar locais
$conn = getPDO();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendar Visita</title>
    <link rel="stylesheet" href="../style/agenda.css">
</head>
<body>
    <header>
        <h1>Agendar Visita</h1>
    </header>

    <div class="container">
        <form method="POST" action="../api/agenda.php">
            <label for="cpf">CPF do Visitante:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>

            <label for="nome">Nome do Visitante:</label><br>
            <input type="text" id="nome" name="nome" readonly><br><br>

            <input type="hidden" id="visitante_id" name="visitante_id">

            <label for="local_id">Local:</label><br>
            <select id="local_id" name="local_id" required>
                <option value="">-- Selecione um local --</option>
                <?php
                $stmt = $conn->query("SELECT id, nome, descricao FROM locais ORDER BY descricao, nome");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['descricao']} - {$row['nome']}</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="data">Data:</label><br>
            <input type="date" id="data" name="data" required value="<?php echo date('Y-m-d'); ?>"><br><br>

            <label for="hora">Hora:</label><br>
            <input type="time" id="hora" name="hora" required value="<?php echo date('H:i'); ?>"><br><br>

            <button type="submit" class="btn">Salvar</button>
        </form>

        <div id="mensagem" style="display:none; color: red; font-weight: bold; margin-top: 10px;"></div>

        <a href="../index.php">⬅ Voltar ao início</a>
    </div>

    <script src="../js/agenda.js"></script>
</body>
</html>