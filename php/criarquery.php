<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $formato = $_POST["formato"];
	$maximo = !empty($_POST["maximo"]) ? $_POST["maximo"] : null;
	$contato = !empty($_POST["contato"]) ? $_POST["contato"] : null;
    $maioridade = isset($_POST["maioridade"]) ? 1 : 0;
	
    if (strlen($nome) > 255) {
        header("Location: ../html/criar.html?error=name");
        exit();
    }
	
	if (strlen($contato) > 255) {
        header("Location: ../html/criar.html?error=contact");
        exit();
    }
	
	$fuso = new DateTimeZone('America/Manaus');
	$dataAtual = new DateTime();
	$dataAtual->setTimezone($fuso);
	$checagemData = new DateTime($data, $fuso);
	
	$dataAtual->setTime(0, 0, 0);
	$checagemData->setTime(0, 0, 0);
	
	if ($dataAtual > $checagemData) {
		header("Location: ../html/criar.html?error=date");
        exit();
	}

    if (criarSorteio($nome, $data, $formato, $maximo, $contato, $maioridade)) {
        header("Location: ../html/hub.html");
        exit();
    } else {
        header("Location: ../html/criar.html?error=function");
        exit();
    }
}

function criarSorteio($nome, $data, $formato, $maximo, $contato, $maioridade) {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "combo";

    $conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conectar->connect_error) {
        die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
    }
	
	session_start();
	$email = $_SESSION["email"];

	$stmt_doc = $conectar->prepare("SELECT documento FROM usuario WHERE email = ?");
	$stmt_doc->bind_param("s", $email);
	$stmt_doc->execute();
	$stmt_doc->bind_result($documento);
	$stmt_doc->fetch();
	$stmt_doc->close();

	$stmt = $conectar->prepare("INSERT INTO sorteio (nome_sorteio, data, formato, maximo_participantes, contato, restricao_maioridade, administrador) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssisis", $nome, $data, $formato, $maximo, $contato, $maioridade, $documento);

    $resultado = $stmt->execute();
	$stmt->close();
	
    $conectar->close();

    return $resultado;
}

?>