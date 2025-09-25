<?php
// api/trocar_senha.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../db.php';

try {
    $pdo = getPDO();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Método inválido']);
        exit;
    }

    $email = trim($_POST['email'] ?? '');
    $novaSenha = $_POST['senha'] ?? '';

    if ($email === '' || $novaSenha === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Email e nova senha são obrigatórios']);
        exit;
    }

    // Procura usuário pelo email
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo json_encode(['error' => '⚠️ Usuário não encontrado!']);
        exit;
    }

    // Atualiza a senha (com hash seguro)
    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $uStmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
    $uStmt->execute([':senha' => $hash, ':id' => $user['id']]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro servidor', 'message' => $e->getMessage()]);
}