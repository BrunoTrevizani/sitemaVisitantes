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
    <title>Controle de Visitantes</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="style/index.js"></script>
</head>
<body>
    <header>
        <h1>Controle de Visitantes</h1>
    </header>

    <nav>
        <a href="views/registro_visitantes.php">Visitantes</a>
        <a href="views/agenda.php">Agendamento</a>
    </nav>

    <div class="container">
        <h2>Bem-vindo!</h2>
        <p>Use o menu acima para acessar as funcionalidades do sistema.</p>
        <form action="api/logout.php" method="post" style="display:inline;">
         <button type="submit" class="logout-btn">Sair</button>
        </form>
    </div>
</body>
</html>
