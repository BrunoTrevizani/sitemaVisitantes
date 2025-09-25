<?php
require_once '../db.php';
session_start();

$conn = getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitante = $_POST['visitante_id'] ?? null;
    $local     = $_POST['local_id'] ?? null;
    $data      = $_POST['data'] ?? null;
    $hora      = $_POST['hora'] ?? null;
    $usuario   = $_SESSION['usuario_id'] ?? null; // pega o usuário logado

    if (!$visitante) {
        $mensagem = "❌ Erro: visitante não identificado.";
    } elseif (!$usuario) {
        $mensagem = "❌ Erro: usuário não identificado (não está logado).";
    } else {
        $sql = "INSERT INTO agenda (visitantes_id, locais_id, data, hora, usuarios_id)
                VALUES (:visitante, :local, :data, :hora, :usuario)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':visitante', $visitante, PDO::PARAM_INT);
        $stmt->bindParam(':local', $local, PDO::PARAM_INT);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $mensagem = "✅ Agendamento salvo com sucesso!";
            $sucesso = true;
        } else {
            $mensagem = "❌ Erro ao salvar: " . implode(", ", $stmt->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Agendamento</title>
    <link rel="stylesheet" href="../style/agenda_resultado.css">
</head>
<body>
    <header>
        <h1>Agendamento</h1>
    </header>

    <div class="container">
        <div class="card">
            <p class="<?= isset($sucesso) ? 'sucesso' : 'erro' ?>">
                <?= $mensagem ?>
            </p>

            <?php if (isset($sucesso)): ?>
                <a href="../views/agenda.php" class="btn">Voltar ao agendamento</a>
                <a href="../index.php" class="btn">Ir ao início</a>
            <?php else: ?>
                <a href="../views/agendar.php" class="btn">Tentar novamente</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>