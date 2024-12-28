<?php

    include('./db/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finances</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="saldo">

        <h1>Seu Saldo é:</h1>

        <span>+R$ 500,00</span>

    </header>

    <section class="middle">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM despesas ORDER BY 'nome' DESC";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row['name']. "</td>";
                        echo "<td>". $row['description']. "</td>";
                        echo "<td>". $row['value']. "</td>";
                        echo "</tr>";
                    }

                ?>
                <form action="">
                    <tr>
                        <td><input type="text" placeholder="Nome"></td>
                        <td><input type="text" placeholder="Descrição"></td>
                        <td><input type="text" placeholder="Valor"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit">Adicionar</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="2">Total:</td>
                    <td colspan="1">R$ 500,00</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM entradas ORDER BY 'nome' DESC";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row['name']. "</td>";
                        echo "<td>". $row['description']. "</td>";
                        echo "<td>". $row['value']. "</td>";
                        echo "</tr>";
                    }

                ?>
                <tr>
                    <td><input type="text" placeholder="Nome"></td>
                    <td><input type="text" placeholder="Descrição"></td>
                    <td><input type="text" placeholder="Valor"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit">Adicionar</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Total: R$ 500,00</td>
                </tr>
                
            </tbody>
        </table>
    </section>
    <section class="middle2">
        <h2>Gráfico de despesas</h2>
        <canvas id="despesasChart">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('despesasChart').getContext('2d');
                const despesasChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                        datasets: [{
                            label: 'Despesas',
                            data: [120, 190, 300, 150, 250, 300, 200, 180, 240, 150, 200, 220],
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                })
            </script>
        </canvas>
    </section>

    <footer class="bottom">
        <a href="">Aprenda a usar o site</a>
    </footer>
</body>
</html>