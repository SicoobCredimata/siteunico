<?php 
header('Content-Type: application/json');
date_default_timezone_set('America/Sao_Paulo');
$dateTimeStr = date('Y-m-d H:i');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
    $communication = trim($_POST['communication']);
    $dataJson = readJson();
    $config = $dataJson['configSystem'];
    $userId = $_SESSION['userId'];
    $conn = dataBaseConn3();


    if($communication == ''){

    }
}?>