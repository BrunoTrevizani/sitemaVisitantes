<?php
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = array();

// Se estiver usando cookies de sessão, apaga também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para o login (que está na raiz)
header("Location: ../login.php");
exit();