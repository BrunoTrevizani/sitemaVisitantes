<?php
// db.php
function getPDO(): PDO {
    $host = '127.0.0.1';
    $db   = 'sistemaVisitantes';
    $user = 'root'; // seu usuário MySQL
    $pass = '';     // senha do MySQL (se houver)
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    return new PDO($dsn, $user, $pass, $opts);
}
