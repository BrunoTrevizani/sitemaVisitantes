document.getElementById('cpf').addEventListener('blur', function() {
    let cpf = this.value;

    fetch('../api/get_visitante.php?cpf=' + cpf)
        .then(response => response.json())
        .then(data => {
            if (data.found) {
                document.getElementById('nome').value = data.nome; // agora é "nome"

                if (!document.getElementById('visitante_id')) {
                    let hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.id = 'visitante_id';
                    hidden.name = 'visitante_id';
                    document.querySelector('form').appendChild(hidden);
                }
                document.getElementById('visitante_id').value = data.id;
            } else {
                document.getElementById('mensagem').style.display = "block";
                document.getElementById('mensagem').innerText = "⚠️ CPF não encontrado! Redirecionando para cadastro...";
                setTimeout(() => {
                    window.location.href = "../views/registro_visitantes.php";
                }, 4000);
            }
        })
        .catch(err => console.error("Erro na requisição:", err));
});