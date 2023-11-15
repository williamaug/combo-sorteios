<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "combo";

$conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conectar->connect_error) {
    die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
}

$email = $_SESSION['email'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "Usuário";
	$novoemail = $_POST["email"];
    $documento = $_POST["documento"];
    $maioridade = isset($_POST["maioridade"]) ? 1 : 0;
	modificarUsuario($nome, $novoemail, $documento, $maioridade, $email);
}

$stmt = $conectar->prepare("SELECT nome_usuario, documento, maioridade FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($nome, $documento, $maioridade);
$stmt->fetch();
$stmt->close();

$conectar->close();

$json_data = json_encode(['nome' => $nome, 'email' => $email, 'documento' => $documento, 'maioridade' => $maioridade]);

if ($json_data === false) {
    die(json_last_error_msg());
}

header('Content-Type: application/json');
echo $json_data;

function modificarUsuario($nome, $novoemail, $documento, $maioridade, $email) {
	
	global $conectar;
	
    $stmt = $conectar->prepare("UPDATE usuario SET nome_usuario = ?, email = ?, documento = ?, maioridade = ? WHERE email = ?");
    $stmt->bind_param("sssis", $nome, $novoemail, $documento, $maioridade, $email);

	$stmt->execute();
    $stmt->close();
	
    $conectar->close();
	
	$_SESSION["email"] = $novoemail;

    header("Location: ../html/usuario.html");
    exit();
}
?>