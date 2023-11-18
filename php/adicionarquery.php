<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
	
	session_start();
	
	switch (verificarSorteio($id)) {
    case 1:
        header("Location: ../html/adicionar.html?error=404");
        exit();
    case 2:
        header("Location: ../html/adicionar.html?error=adm");
        exit();
	case 3:
        header("Location: ../html/adicionar.html?error=added");
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
		$checagem_added = null;
		
		$stmt_insc = $conectar->prepare("SELECT i.id_sorteio
									   FROM inscricao i
									   JOIN usuario u ON i.documento_participante = u.documento
									   WHERE u.email = ?");
		$stmt_insc->bind_param("s", $email);
		$stmt_insc->execute();
		$stmt_insc->bind_result($checagem_added);
		$stmt_insc->fetch();
		$stmt_insc->close();
		
		if ($checagem_added == $id) {
			return 3;
		} else {
			return 0;
		}
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
	
	$email = $_SESSION["email"];

	$stmt_doc = $conectar->prepare("SELECT documento FROM usuario WHERE email = ?");
	$stmt_doc->bind_param("s", $email);
	$stmt_doc->execute();
	$stmt_doc->bind_result($documento);
	$stmt_doc->fetch();
	$stmt_doc->close();
	
	$contagem = 0;
	$maximo = 4294967295;
	
	$stmt_num = $conectar->prepare("SELECT COUNT(id_sorteio) FROM inscricao WHERE id_sorteio = ?");
	$stmt_num->bind_param("i", $id);
	$stmt_num->execute();
	$stmt_num->bind_result($contagem);
	$stmt_num->fetch();
	$stmt_num->close();
	
	$stmt_max = $conectar->prepare("SELECT s.maximo_participantes
									FROM sorteio s
									JOIN inscricao i ON s.id_sorteio = i.id_sorteio
									WHERE i.id_sorteio = ?");
	$stmt_max->bind_param("i", $id);
	$stmt_max->execute();
	$stmt_max->bind_result($maximo);
	$stmt_max->fetch();
	$stmt_max->close();
	
	$numero = $contagem + 1;
	if ($numero > $maximo) {
		echo "Numero: $numero, Maximo: $maximo"; 
        exit();
	}

	$stmt = $conectar->prepare("INSERT INTO inscricao (id_sorteio, documento_participante, numero) VALUES (?, ?, ?)");
	$stmt->bind_param("isi", $id, $documento, $numero);

    $resultado = $stmt->execute();

    $stmt->close();
    $conectar->close();

    return $resultado;
}

?>