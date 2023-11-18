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

$listSortAdm = [];
$listIdAdm = [];
$listSortPar = [];
$listIdPar = [];

$email = $_SESSION['email'];

$stmt = $conectar->prepare("SELECT documento FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($documento);
$stmt->fetch();
$stmt->close();

$sqlAdm = "SELECT s.nome_sorteio, s.id_sorteio
           FROM sorteio s
           JOIN usuario u ON s.administrador = u.documento
           WHERE u.documento = '$documento'";

$resultAdm = $conectar->query($sqlAdm);

if ($resultAdm->num_rows > 0) {
    while ($row = $resultAdm->fetch_assoc()) {
        $listSortAdm[] = $row['nome_sorteio'];
		$listIdAdm[] = $row['id_sorteio'];
    }
}

$sqlPar = "SELECT s.nome_sorteio, s.id_sorteio
           FROM sorteio s
           JOIN inscricao i ON s.id_sorteio = i.id_sorteio
           JOIN usuario u ON i.documento_participante = u.documento
           WHERE u.documento = '$documento'";

$resultPar = $conectar->query($sqlPar);

if ($resultPar->num_rows > 0) {
    while ($row = $resultPar->fetch_assoc()) {
        $listSortPar[] = $row['nome_sorteio'];
		$listIdPar[] = $row['id_sorteio'];
    }
}

$conectar->close();

$json_data = json_encode(['listSortAdm' => $listSortAdm, 'listIdAdm' => $listIdAdm,'listSortPar' => $listSortPar, 'listIdPar' => $listIdPar]);

if ($json_data === false) {
    die(json_last_error_msg());
}

header('Content-Type: application/json');
echo $json_data;
?>