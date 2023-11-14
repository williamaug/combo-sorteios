<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (verificarCredenciais($email, $senha)) {
        $_SESSION["email"] = $email;
        header("Location: hub.php");
        exit();
    } else {
        header("Location: ../html/login.html?error");
		exit();
    }
}

function verificarCredenciais($email, $senha) {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "combo";

    $conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conectar->connect_error) {
        die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
    }

    $stmt = $conectar->prepare("SELECT senha FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($senha_criptografada);
    $stmt->fetch();
    $stmt->close();

    return password_verify($senha, $senha_criptografada);
}

?>