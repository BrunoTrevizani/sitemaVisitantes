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
    <meta charset="UTF-8">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../style/relatorios.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Painel de Relatórios</h1>
    <div class="cards">
        <div class="card" id="cardHoje">Visitantes Hoje: ...</div>
        <div class="card" id="cardSemana">Visitantes Semana: ...</div>
        <div class="card" id="cardMes">Visitantes Mês: ...</div>
        <div class="card" id="cardAgend">Agendamentos Mês: ...</div>
    </div>

    <canvas id="graficoVisitas"></canvas>

    <script>
        async function carregarRelatorios() {
            const response = await fetch("../api/relatorios.php");
            const data = await response.json();

            document.getElementById("cardHoje").innerText = "Visitantes Hoje: " + data.visitantesHoje;
            document.getElementById("cardSemana").innerText = "Visitantes Semana: " + data.visitantesSemana;
            document.getElementById("cardMes").innerText = "Visitantes Mês: " + data.visitantesMes;
            document.getElementById("cardAgend").innerText = "Agendamentos Mês: " + data.agendamentosMes;

            new Chart(document.getElementById("graficoVisitas"), {
                type: 'bar',
                data: {
                    labels: ['Hoje', 'Semana', 'Mês', 'Agendamentos'],
                    datasets: [{
                        label: 'Totais',
                        data: [data.visitantesHoje, data.visitantesSemana, data.visitantesMes, data.agendamentosMes]
                    }]
                }
            });
        }
        carregarRelatorios();
    </script>
</body>
</html>