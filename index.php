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

    <?php
    
        $query = "SELECT * FROM despesas ORDER BY 'nome' DESC";
        $resultS = mysqli_query($connection, $query);
        $query = "SELECT * FROM entradas ORDER BY 'nome' DESC";
        $resultE = mysqli_query($connection, $query);

        $despesas = 0;
        $entradas = 0; 
        while ($row = mysqli_fetch_assoc($resultE)) {
            $entradas += $row['value'];
        }

        while ($row = mysqli_fetch_assoc($resultS)) {
            $despesas += $row['value']; 
        }

    ?>

    <header class="saldo">

        <h1>Seu Saldo é:</h1>

        <span>
            
            R$<?php echo$entradas-$despesas; ?>
    
        </span>

    </header>

    <section class="middle container">
        <table class="table table-hover col-sm-6">
            <thead>
                <tr>
                    <th class="h1 text-center" colspan="3">Despesas</th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM despesas ORDER BY 'nome' DESC";
                    $resultS = mysqli_query($connection, $query);

                    $total = 0;

                    while ($row = mysqli_fetch_assoc($resultS)) {
                        echo "<tr>";
                        echo "<td class=\"nameD\">". $row['name']. "</td>";
                        echo "<td>". $row['description']. "</td>";
                        echo "<td class=\"valueD\">". $row['value']. "</td>";
                        echo "</tr>";
                        $total+=$row['value'];
                    }

                ?>
                <form action="addD.php" method="get">
                    <tr>
                        <td><input class="form-control" type="text" placeholder="Nome"></td>
                        <td><input class="form-control" type="text" placeholder="Descrição"></td>
                        <td><input class="form-control" type="text" placeholder="Valor"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-primary col-sm-12">Adicionar</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="2">Total:</td>
                    <td colspan="1">R$ <?php echo$total ?></td>
                </tr>
            </tbody>
        </table>
                    <br><br>
        <table class="table table-hover col-sm-6">
            <thead>
                <tr>
                    <th class="h1 text-center" colspan="3">Entradas</th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = "SELECT * FROM entradas ORDER BY 'nome' DESC";
                    $resultE = mysqli_query($connection, $query);

                    $total = 0;

                    while ($row = mysqli_fetch_assoc($resultE)) {
                        echo "<tr>";
                        echo "<td class=\"name\">". $row['name']. "</td>";
                        echo "<td>". $row['description']. "</td>";
                        echo "<td>". $row['value']. "</td>";
                        echo "</tr>";
                        $total+=$row['value'];
                    }

                ?>
                <form action="addE.php" method="get">
                    <tr>
                        <td><input class="form-control" type="text" placeholder="Nome"></td>
                        <td><input class="form-control" type="text" placeholder="Descrição"></td>
                        <td><input class="form-control" type="text" placeholder="Valor"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-primary col-sm-12">Adicionar</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="2">Total:</td>
                    <td colspan="1">R$ <?php echo$total ?></td>
                </tr>
                
            </tbody>
        </table>
    </section>
    <br><hr><br>
    <section class="middle2 container">
        <h2>Gráfico de despesas: </h2>
        <canvas id="despesasChart">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>

                const names = document.getElementsByClassName('nameD');
                const values = document.getElementsByClassName('valueD');

                const namesArray = Array.from(names).map(name => name.textContent);
                const valuesArray = Array.from(values).map(value => parseFloat(value.textContent));

                const ctx = document.getElementById('despesasChart').getContext('2d');
                const despesasChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: namesArray,
                        datasets: [{
                            label: 'Despesas',
                            data: valuesArray,
                            backgroundColor: 'rgba(192, 75, 75, 0.6)',
                            borderColor: 'rgba(192, 75, 75, 1)',
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