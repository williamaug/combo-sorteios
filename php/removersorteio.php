<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "combo";

$conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conectar->connect_error) {
    die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
}

$stmt = $conectar->prepare("DELETE FROM sorteio WHERE id_sorteio = ?;");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$conectar->close();
?>