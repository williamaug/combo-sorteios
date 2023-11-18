<?php
session_start();

$checagem = ["sessao" => false];

if (isset($_SESSION['email'])) {
    $checagem["sessao"] = true;
}

echo json_encode($checagem);
?>