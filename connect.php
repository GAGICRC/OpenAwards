 <?php
$servername = "localhost";

$username = "root";
$password = "";
$database = "votos";

// cria nova ligação
$conn = new mysqli($servername, $username, $password, $database);

// verifica se houve erros a ligar
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?> 