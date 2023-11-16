<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

	switch (verificarSorteio($id)) {
    case 1:
        header("Location: ../html/adicionar.html?error=404");
        exit();
    case 2:
        header("Location: ../html/adicionar.html?error=adm");
        exit();
    default:
		break;
	}

    if (adicionarSorteio($id)) {
        header("Location: ../html/hub.html");
        exit();
    } else {
        header("Location: ../html/adicionar.html?error=function");
        exit();
    }
}

function verificarSorteio($id) {
	
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "combo";

    $conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conectar->connect_error) {
        die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
    }
	
	$sorteios = [];

	session_start();
	$email = $_SESSION['email'];
	
	$checagem = null;

	$stmt = $conectar->prepare("SELECT u.email
							   FROM usuario u
							   JOIN sorteio s ON u.documento = s.administrador
							   WHERE s.id_sorteio = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($checagem);
	$stmt->fetch();
	$stmt->close();
	
	if ($checagem === null ) {
		return 1;
	} else if ($checagem === $email) {
		return 2;
	} else {
		return 0;
	}
}

function adicionarSorteio($id) {
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

	$stmt = $conectar->prepare("INSERT INTO inscricao (id_sorteio, documento_participante) VALUES (?, ?)");
	$stmt->bind_param("is", $id, $documento);

    $resultado = $stmt->execute();

    $stmt->close();
    $conectar->close();

    return $resultado;
}

?>