<?php
$jsonString = file_get_contents('php://input');
$dados = json_decode($jsonString, true);

$numArray = $dados['numArray'];
$id = $dados['id'];

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "combo";

$conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conectar->connect_error) {
	die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
}

$emailArray = [];

for($i = 0; $i < count($numArray); $i++) {
	$stmt = $conectar->prepare("SELECT u.email
								FROM usuario u
								JOIN inscricao i ON u.documento = i.documento_participante
								WHERE i.id_sorteio = ? AND i.numero = ?");
	$stmt->bind_param("ii", $id, $numArray[$i]);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->fetch();
	$emailArray[] = $email;
	$stmt->close();
}

$conectar->close();

echo json_encode($emailArray);
?>