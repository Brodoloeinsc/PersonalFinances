<?php
    include('./db/db.php');

    // Validação: 'name' e 'value' são obrigatórios
    if (isset($_GET['name'], $_GET['value'])) {
        $name = $_GET['name'];
        $value = $_GET['value'];
        $description = isset($_GET['description']) ? $_GET['description'] : null;

        // Preparação da query
        $stmt = mysqli_prepare(
            $connection,
            "INSERT INTO entradas (name, description, value) VALUES (?, ?, ?)"
        );
        
        if ($stmt) {
            // Associa parâmetros
            mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $value); // 'ssd' (string, string, double)

            // Executa a query
            if (mysqli_stmt_execute($stmt)) {
                echo "Entrada inserida com sucesso!";
            } else {
                echo "Erro ao inserir entrada: " . mysqli_error($connection);
            }

            // Fecha a preparação
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da query: " . mysqli_error($connection);
        }
    } else {
        echo "Os campos 'name' e 'value' são obrigatórios.";
    }
?>
