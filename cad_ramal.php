<?php
// index.php

include 'config.php';

function limpar_dados($dados) {
    global $conn;
    $dados = mysqli_escape_string($conn, $dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

if (isset($_POST['submit'])) {
    $departamento = limpar_dados($_POST['departamento']);
    $funcao = limpar_dados($_POST['funcao']);
    $colaborador = limpar_dados($_POST['colaborador']);
    $email = limpar_dados($_POST['email']);
    $ramal = limpar_dados($_POST['ramal']);
    $celular = limpar_dados($_POST['celular']);

    $sql = "INSERT INTO ramais (departamento, funcao, colaborador, email, ramal, celular) 
            VALUES ('$departamento', '$funcao', '$colaborador', '$email', '$ramal', '$celular')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Ramal cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o ramal: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Ramais</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Ramais</h2>
        <form method="post">
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" required>
            </div>
            <div class="form-group">
                <label for="funcao">Função:</label>
                <input type="text" class="form-control" id="funcao" name="funcao" required>
            </div>
            <div class="form-group">
                <label for="colaborador">Colaborador:</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="ramal">Ramal:</label>
                <input type="text" class="form-control" id="ramal" name="ramal" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
