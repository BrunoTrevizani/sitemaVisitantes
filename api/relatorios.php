<?php
// api/relatorios.php
header('Content-Type: application/json; charset=utf-8');

// inclui a função getPDO(); ajuste o caminho se necessário
require_once __DIR__ . '/../db.php';

try {
    $pdo = getPDO(); // <-- aqui criamos a conexão (era esse o problema)
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'db_connection_failed', 'message' => $e->getMessage()]);
    exit;
}

try {
    // Usando a tabela "agenda" (conforme seu print: id, visitantes_id, locais_id, data, hora, usuarios_id)
    $queries = [
        'hoje' => "SELECT COUNT(*) AS total FROM agenda WHERE DATE(data) = CURDATE()",
        'semana' => "SELECT COUNT(*) AS total FROM agenda WHERE YEARWEEK(data, 1) = YEARWEEK(CURDATE(), 1)",
        'mes' => "SELECT COUNT(*) AS total FROM agenda WHERE YEAR(data) = YEAR(CURDATE()) AND MONTH(data) = MONTH(CURDATE())",
        // se você tratar "agendamentos" como a mesma tabela agenda, pode usar a mesma query do mês
        'agendamentosMes' => "SELECT COUNT(*) AS total FROM agenda WHERE YEAR(data) = YEAR(CURDATE()) AND MONTH(data) = MONTH(CURDATE())"
    ];

    $result = [];
    foreach ($queries as $key => $sql) {
        $stmt = $pdo->query($sql);
        $row = $stmt ? $stmt->fetch() : null;
        $result[$key] = isset($row['total']) ? (int)$row['total'] : 0;
    }

    // Retorna no formato que sua view espera
    echo json_encode([
        'visitantesHoje'   => $result['hoje'],
        'visitantesSemana' => $result['semana'],
        'visitantesMes'    => $result['mes'],
        'agendamentosMes'  => $result['agendamentosMes']
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'query_failed', 'message' => $e->getMessage()]);
}