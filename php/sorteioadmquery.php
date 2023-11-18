<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "combo";

$conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conectar->connect_error) {
    die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
	$data = $_POST["data"];
    $contato = !empty($_POST["contato"]) ? $_POST["contato"] : null;
	$formato = $_POST["formato"];
    $maioridade = isset($_POST["maioridade"]) ? 1 : 0;
	$maximo = !empty($_POST["maximo"]) ? $_POST["maximo"] : null;
	$id = $_POST["id"];
	
	$checagemId = null;
	
	$stmt_id = $conectar->prepare("SELECT nome_sorteio FROM sorteio WHERE id_sorteio = ?");
	$stmt_id->bind_param("i", $id);
	$stmt_id->execute();
	$stmt_id->bind_result($checagemId);
	$stmt_id->fetch();
	$stmt_id->close();
	
	if ($checagemId === null) {
        header("Location: ../html/sorteioadm.html?id=" . $id . "&error=id");
        exit();
    }
	
	if (strlen($nome) > 255) {
        header("Location: ../html/sorteioadm.html?id=" . $id . "&error=name");
        exit();
    }
	
	if (strlen($contato) > 255) {
        header("Location: ../html/sorteioadm.html?id=" . $id . "&error=contact");
        exit();
    }
	
	$dataAtual = new DateTime();
	$checagemData = new DateTime($data);

	if ($dataAtual > $checagemData) {
		header("Location: ../html/sorteioadm.html?id=" . $id . "&error=date");
        exit();
	}
	
	modificarSorteio($nome, $data, $contato, $formato, $maioridade, $maximo, $id);
}

$id = $_GET['id'];

$stmt = $conectar->prepare("SELECT nome_sorteio, data, contato, formato, restricao_maioridade, maximo_participantes FROM sorteio WHERE id_sorteio = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome, $data, $contato, $formato, $maioridade, $maximo);
$stmt->fetch();
$stmt->close();

$stmt_insc = $conectar->prepare("SELECT i.id_inscricao
								FROM inscricao i
								JOIN sorteio s ON i.id_sorteio = s.id_sorteio
								WHERE s.id_sorteio = ?");

$stmt_insc->bind_param("i", $id);
$stmt_insc->execute();
$stmt_insc->store_result();
$inscritos = $stmt_insc->num_rows;
$stmt_insc->close();

$conectar->close();

$json_data = json_encode(['nome' => $nome, 'date' => $data, 'formato' => $formato, 'maximo' => $maximo, 'contato' => $contato, 'maioridade' => $maioridade, 'inscritos' => $inscritos]);

if ($json_data === false) {
    die(json_last_error_msg());
}

header('Content-Type: application/json');
echo $json_data;

function modificarSorteio($nome, $data, $contato, $formato, $maioridade, $maximo, $id) {
	
	global $conectar;
	
    $stmt = $conectar->prepare("UPDATE sorteio SET nome_sorteio = ?, data = ?, contato = ?, formato = ?, restricao_maioridade = ?, maximo_participantes = ? WHERE id_sorteio = ?");
    $stmt->bind_param("ssssiii", $nome, $data, $contato, $formato, $maioridade, $maximo, $id);

	$stmt->execute();
    $stmt->close();
	
    $conectar->close();

    header("Location: ../html/sorteioadm.html?id=" . $id);
    exit();
}
?>