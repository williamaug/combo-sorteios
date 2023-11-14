<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $documento = $_POST["documento"];
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : $documento;
    $maioridade = isset($_POST["maioridade"]) ? 1 : 0;

    $erro = null;

    if (strlen($nome) > 255) {
        $erro = "nome";
    } elseif (strlen($email) > 255) {
        $erro = "email";
    } elseif (strlen($documento) > 18) {
        $erro = "documento";
    }

    if ($erro !== null) {
        header("Location: ../html/cadastro.html?lengtherror=" . $erro);
        exit();
    }

    if (verificarExistente($email, $documento)) {
        header("Location: ../html/cadastro.html?error");
        exit();
    }

    if (cadastrarUsuario($email, $senha, $documento, $nome, $maioridade)) {
        session_start();
        $_SESSION["email"] = $email;
        header("Location: hub.php");
        exit();
    } else {
        header("Location: ../html/cadastro.html?error");
        exit();
    }
}

function verificarExistente($email, $documento) {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "combo";

    $conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conectar->connect_error) {
        die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
    }

    $stmt = $conectar->prepare("SELECT senha FROM usuario WHERE email = ? OR documento = ?");
    $stmt->bind_param("ss", $email, $documento);
    $stmt->execute();
    $stmt->bind_result($senha_criptografada);
    $stmt->fetch();
    $stmt->close();

    if ($senha_criptografada !== null) {
        $conectar->close();
        return true;
    }

    $conectar->close();
    return false;
}

function cadastrarUsuario($email, $senha, $documento, $nome, $maioridade) {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "combo";

    $conectar = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conectar->connect_error) {
        die("Falha na conexão. Mensagem de erro: " . $conectar->connect_error);
    }

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conectar->prepare("INSERT INTO usuario (email, senha, documento, nome_usuario, maioridade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $email, $senha_criptografada, $documento, $nome, $maioridade);

    $resultado = $stmt->execute();

    $stmt->close();
    $conectar->close();

    return $resultado;
}

?>