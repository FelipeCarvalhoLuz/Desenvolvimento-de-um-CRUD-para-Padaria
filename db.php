<?php
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "PaoDango_Equipe8";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}
?>