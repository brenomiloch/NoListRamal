<?php
// config.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_ramal";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

function limpar_dados($dados) {
    global $conn;
    $dados = mysqli_escape_string($conn, $dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}
?>
