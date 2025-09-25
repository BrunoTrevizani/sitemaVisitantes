<?php
// api/funcionarios.php
require_once("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getPDO();

    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = preg_replace('/\D/', '', $_POST['cpf'] ?? ''); // só números
    $cargo    = trim($_POST['cargo'] ?? '');
    $setor    = trim($_POST['setor'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    // Verifica duplicado
    $check = $pdo->prepare("SELECT 1 FROM funcionarios WHERE cpf = ? LIMIT 1");
    $check->execute([$cpf]);

    if ($check->fetch()) {
        // Já existe
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <title>Erro no Registro</title>
            <link rel="stylesheet" href="../style/visitantes.css">
        </head>
        <body>
            <header>Registro de Funcionário</header>
            <div class="container">
                <p>⚠️ Esse CPF já está cadastrado!</p>
                <a href="../views/registro_funcionarios.php" class="button-link">Voltar ao registro</a>
                <a href="../index_admin.php" class="button-link">Ir ao início</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    // Se não existir, insere
    $sql = "INSERT INTO funcionarios (nome, cpf, cargo, setor, telefone) 
            VALUES (:nome, :cpf, :cargo, :setor, :telefone)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'     => $nome,
        ':cpf'      => $cpf,
        ':cargo'    => $cargo,
        ':setor'    => $setor,
        ':telefone' => $telefone,
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
        <header>Registro de Funcionário</header>
        <div class="container">
            <p>✅ Funcionário registrado com sucesso!</p>
            <a href="../views/registro_funcionarios.php" class="button-link">Voltar ao registro</a>
            <a href="../index_admin.php" class="button-link">Ir ao início</a>
        </div>
    </body>
    </html>

<?php
} else {
    echo "Método inválido!";
}