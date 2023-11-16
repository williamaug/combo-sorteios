<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $formato = $_POST["formato"];
    $maioridade = isset($_POST["maioridade"]) ? 1 : 0;

    if (strlen($nome) > 255) {
        header("Location: ../html/criar.html?error=length");
        exit();
    }
	
	$dataAtual = new DateTime();
	$checagemData = new DateTime($data);

	if ($dataAtual > $checagemData) {
		header("Location: ../html/criar.html?error=date");
        exit();
	}

    if (criarSorteio($nome, $data, $formato, $maioridade)) {
        header("Location: ../html/hub.html");
        exit();
    } else {
        header("Location: ../html/criar.html?error=function");
        exit();
    }
}


function criarSorteio($nome, $data, $formato, $maioridade) {
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

	$stmt = $conectar->prepare("INSERT INTO sorteio (nome_sorteio, data, formato, restricao_maioridade, administrador) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssis", $nome, $data, $formato, $maioridade, $documento);

    $resultado = $stmt->execute();

    $stmt->close();
    $conectar->close();

    return $resultado;
}

?>