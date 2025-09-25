<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Trocar Senha</title>
    <link rel="stylesheet" href="../style/trocar_senha.css">
    <style>
        .box { max-width:480px; margin:40px auto; background:#fff; padding:20px; border-radius:6px; box-shadow:0 2px 8px rgba(0,0,0,0.06); }
        label{display:block;margin-top:10px}
        input{width:100%;padding:8px;margin-top:6px;border:1px solid #ccc;border-radius:4px}
        .actions{margin-top:14px;display:flex;gap:8px}
    </style>
</head>
<body>
    <header>
    <h1>Trocar Senha</h1>
    </header>
    <div class="box">
        <h3>Informe o email do funcionário já cadastrado e a nova senha:</h3>

        <form id="formTrocarSenha">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Nova senha</label>
            <input type="password" id="senha" name="senha" required minlength="6">

            <div class="actions">
                <button type="submit" class="btn">Alterar senha</button>
                <a href="registro_usuarios.php" class="btn">Cancelar</a>
            </div>

            <p id="msg" style="margin-top:10px;color:green;"></p>
        </form>
    </div>

<script>
document.getElementById('formTrocarSenha').addEventListener('submit', async function(e){
    e.preventDefault();
    document.getElementById('msg').textContent = '';

    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    if(!email || !senha) return alert('Preencha email e a nova senha.');

    const fd = new FormData();
    fd.append('email', email);
    fd.append('senha', senha);

    try {
        const res = await fetch('../api/trocar_senha.php', { method: 'POST', body: fd });
        const data = await res.json();

        if (res.ok && data.success) {
            document.getElementById('msg').style.color = 'green';
            document.getElementById('msg').textContent = 'Senha alterada com sucesso.';
            setTimeout(()=> location.href = 'registro_usuarios.php', 2500);
        } else {
            document.getElementById('msg').style.color = 'red';
            document.getElementById('msg').textContent = data.error || 'Erro desconhecido';
        }
    } catch (err) {
        console.error(err);
        document.getElementById('msg').style.color = 'red';
        document.getElementById('msg').textContent = 'Erro de comunicação com o servidor.';
    }
});
</script>
</body>
</html>