<?php
function readJson()
{ //LEITURA DO ARQUIVO JSON
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json');
    $data = json_decode($json, true);
    return $data;
}

function dataBaseConn()
{ //CONE    XÃO COM BANCO DE DADOS
    $dbServer = "172.19.55.218";
    $dbUser = "mariaelisa";
    $dbPass = "Sicoob2024";
    $dbName = "sandbox_projects";

    try {
        $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
    } catch (\Throwable $th) {
        die(require_once($_SERVER['DOCUMENT_ROOT'] . '/errs/dataBaseError.php'));
    }
    return $conn;
}