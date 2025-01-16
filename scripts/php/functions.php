<?php

function readJson()
{ //LEITURA DO ARQUIVO JSON
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json');
    $data = json_decode($json, true);
    return $data;
}
