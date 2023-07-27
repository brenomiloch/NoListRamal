<?php
// visualizar_ramais.php

include 'config.php';

if (isset($_GET['delete']) && $_GET['delete'] == 'true' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ramais WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Ramal excluído com sucesso!";
    } else {
        echo "Erro ao excluir o ramal: " . $conn->error;
    }
}else{$sql = "SELECT * FROM ramais";}

// Pesquisa de ramais
if (isset($_GET['pesquisar'])) {
    $termo_pesquisa = limpar_dados($_GET['pesquisar']);
    $sql = "SELECT * FROM ramais 
            WHERE departamento LIKE '%$termo_pesquisa%'
            OR funcao LIKE '%$termo_pesquisa%'
            OR colaborador LIKE '%$termo_pesquisa%'
            OR email LIKE '%$termo_pesquisa%'
            OR ramal LIKE '%$termo_pesquisa%'
            OR celular LIKE '%$termo_pesquisa%'";
} else {
    $sql = "SELECT * FROM ramais";
}


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Ramais</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css.css">
</head>
<body>




<div class="container">
        <h2>Visualizar Ramais</h2>
        <div class="form-group col-3">
            <form method="get">
                <input type="text" class="form-control" name="pesquisar" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
            </form>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Departamento</th>
                <th>Função</th>
                <th>Colaborador</th>
                <th>E-mail</th>
                <th>Ramal</th>
                <th>Celular</th>
                <?php if ($result->num_rows > 0) : ?>
                <th>Ação</th>
                <?php endif; ?>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['departamento'] . "</td>";
                    echo "<td>" . $row['funcao'] . "</td>";
                    echo "<td>" . $row['colaborador'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['ramal'] . "</td>";
                    echo "<td>" . $row['celular'] . "</td>";
                    echo "<td><a href='visualizar_ramais.php?delete=true&id=" . $row['id'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum ramal cadastrado.</td></tr>";
            }
            ?>
        </table>
        <a href="cad_ramal.php">
            <button type="button" class="btn btn-outline-dark" href="cad_ramal.php">
                Cadastrar
            </button>
            </a>
    </div>
    
</body>
</html>
