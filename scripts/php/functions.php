<?php
function readJson()
{ //LEITURA DO ARQUIVO JSON
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json');
    $data = json_decode($json, true);
    return $data;
}

function dataBaseConn($option = false)
{ //CONEXÃO COM BANCO DE DADOS
    //$dataJson = readJson();
    if ($option == true) {
        $dbServer = "192.185.176.136";
        $dbUser = "sicoob09_sicoobcredimata";
        $dbPass = "Sicoob@84534857a12";
        $dbName = "sicoob09_projects";

        try {
            $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
        } catch (\Throwable $th) {
            die('erro ao conectar com o banco de dados');
        }
    } else if ($option == false) {
        $dbServer = "172.19.55.218";
        $dbUser = "mariaelisa";
        $dbPass = "Sicoob2024";
        $dbName = "sandbox_projects";

        try {
            $conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
        } catch (\Throwable $th) {
            die('erro ao conectar com o banco de dados');
        }
    }
    return @$conn;
}
