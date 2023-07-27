<?php
// editar_ramal.php

include 'config.php';

function limpar_dados($dados) {
    global $conn;
    $dados = mysqli_escape_string($conn, $dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $departamento = limpar_dados($_POST['departamento']);
    $funcao = limpar_dados($_POST['funcao']);
    $colaborador = limpar_dados($_POST['colaborador']);
    $email = limpar_dados($_POST['email']);
    $ramal = limpar_dados($_POST['ramal']);
    $celular = limpar_dados($_POST['celular']);

    $sql = "UPDATE ramais SET departamento='$departamento', funcao='$funcao', colaborador='$colaborador', email='$email', ramal='$ramal', celular='$celular' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Ramal atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o ramal: " . $conn->error;
    }
}

if (isset($_GET['edit']) && $_GET['edit'] == 'true' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM ramais WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $departamento = $row['departamento'];
        $funcao = $row['funcao'];
        $colaborador = $row['colaborador'];
        $email = $row['email'];
        $ramal = $row['ramal'];
        $celular = $row['celular'];
    } else {
        echo "Ramal não encontrado.";
        exit;
    }
} else {
    echo "ID do ramal não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Ramal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Editar Ramal</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required>
            </div>
            <div class="form-group">
                <label for="funcao">Função:</label>
                <input type="text" class="form-control" id="funcao" name="funcao" value="<?php echo $funcao; ?>" required>
            </div>
            <div class="form-group">
                <label for="colaborador">Colaborador:</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="<?php echo $colaborador; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="ramal">Ramal:</label>
                <input type="text" class="form-control" id="ramal" name="ramal" value="<?php echo $ramal; ?>" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $celular; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</body>
</html>
