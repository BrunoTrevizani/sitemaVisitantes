<?php
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDO();

    $nome    = trim($_POST['nome'] ?? '');
    $cpf     = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // só números
    $empresa = trim($_POST['empresa'] ?? '');
    $contato = trim($_POST['contato'] ?? '');

    // Verifica se já existe o CPF no banco
    $check = $pdo->prepare("SELECT 1 FROM visitantes WHERE cpf = ? LIMIT 1");
    $check->execute([$cpf]);

    if ($check->fetch()) {
        // CPF já cadastrado
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <title>Erro no Registro</title>
            <link rel="stylesheet" href="../style/visitantes.css">
        </head>
        <body>
            <header>Registro de Visitante</header>
            <div class="container">
                <p>⚠️ Esse CPF já está cadastrado!</p>
                <a href="../views/registro_visitantes.php" class="button-link">Voltar ao registro</a>
                <a href="../index.php" class="button-link">Ir ao início</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    // Se não existir, faz o insert
    $sql = "INSERT INTO visitantes (name, cpf, company, phone) 
            VALUES (:nome, :cpf, :empresa, :contato)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'    => $nome,
        ':cpf'     => $cpf,
        ':empresa' => $empresa,
        ':contato' => $contato,
    ]);
    ?>

    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Registro Concluído</title>
        <link rel="stylesheet" href="../style/visitantes.css">
    </head>
    <body>
        <header>Registro de Visitante</header>
        <div class="container">
            <p>✅ Visitante registrado com sucesso!</p>
            <a href="../views/registro_visitantes.php" class="button-link">Voltar ao registro</a>
            <a href="../index.php" class="button-link">Ir ao início</a>
        </div>
    </body>
    </html>

<?php
} else {
    echo "Método inválido!";
}