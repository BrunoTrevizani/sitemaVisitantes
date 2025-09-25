
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Visitantes</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Funcionário</h2>
        <form action="api/login.php" method="POST">
            <label for="usuario">Nome ou Email</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit" class="btn">Entrar</button>
        </form>
        <br>
        <?php if (isset($_GET['erro'])): ?>
            <p class="erro">Usuário ou senha inválidos</p>
        <?php endif; ?>
        
    </div>
    
</body>
</html>