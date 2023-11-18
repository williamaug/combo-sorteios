<?php
$id = $_GET['id'];

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "combo";

$conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conectar->connect_error) {
    die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
}

$stmt = $conectar->prepare("SELECT nome_sorteio, data, contato, formato, restricao_maioridade, maximo_participantes FROM sorteio WHERE id_sorteio = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome, $data, $contato, $formato, $maioridade, $maximo);
$stmt->fetch();
$stmt->close();

session_start();
$email = $_SESSION['email'];

$stmt_num = $conectar->prepare("SELECT numero FROM inscricao i JOIN usuario u ON i.documento_participante = u.documento WHERE u.email = ?");
$stmt_num->bind_param("s", $email);
$stmt_num->execute();
$stmt_num->bind_result($numero);
$stmt_num->fetch();
$stmt_num->close();

$conectar->close();

$json_data = json_encode(['nome' => $nome, 'date' => $data, 'formato' => $formato, 'maximo' => $maximo, 'contato' => $contato, 'maioridade' => $maioridade, 'numero' => $numero]);

if ($json_data === false) {
    die(json_last_error_msg());
}

header('Content-Type: application/json');
echo $json_data;
?>