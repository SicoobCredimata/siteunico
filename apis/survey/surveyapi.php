<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Sao_Paulo');
$dateTimeStr = date('Y-m-d H:i');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/scripts/php/functions.php');
    $communication = trim($_POST['communication']);
  

    if ($communication == 'submitSurvey') {
        $conn = dataBaseConn();
        $pa = isset($_POST['pa']) ? trim($_POST['pa']) : '';
        $cpfAssoc = isset($_POST['cpfAssoc']) ? trim($_POST['cpfAssoc']) : '';
        $nameColab = isset($_POST['nameColab']) ? trim($_POST['nameColab']) : '';
        $valueSoluc  = isset($_POST['valueSoluc']) ? trim($_POST['valueSoluc']) : '';
        $valueAtend = isset($_POST['valueAtend']) ? trim($_POST['valueAtend']) : '';
        $valueCordi = isset($_POST['valueCordi']) ? trim($_POST['valueCordi']) : '';
        $valueProbab = isset($_POST['valueProbab']) ? trim($_POST['valueProbab']) : '';
        $commentsAssoc = isset($_POST['commentsAssoc']) ? trim($_POST['commentsAssoc']) : '';
        $dateTimeStr = date('Y-m-d H:i');

        // Validação básica dos dados: verifica se algum desses está vazio
        if (empty($cpfAssoc) || empty($nameColab) || $valueSoluc==='' || $valueAtend==='' || $valueCordi==='' || $valueProbab==='') {
            echo json_encode(['response' => 'error', 'message' => 'Campos obrigatórios não preenchidos']);
            exit;
        }
        // Verifica se o CPF está no formato correto
        if (!preg_match("/^\d{3}\.\d{3}\.\d{3}-\d{2}$/", $cpfAssoc)) {
            echo json_encode(['response' => 'error', 'message' => 'CPF inválido']);
            exit;
        }
        

        //Inserir os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO sur_answers (idPa, cpfAssoc, idColab, valueSoluc, valueAtend, valueCordi, valueProbab, commentsAssoc, dateComment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
 
        if ($stmt->execute([$pa, $cpfAssoc, $nameColab, $valueSoluc, $valueAtend, $valueCordi, $valueProbab, $commentsAssoc, $dateTimeStr])) {
            $response = 'success';
            echo (json_encode(['date' => $dateTimeStr, 'response' => $response, 'message' => 'Alterações realizadas com sucesso']));
        } else {
            echo json_encode(['response' => 'error', 'message' => 'Erro ao salvar o formulário.']);
        }
        $stmt->close();
        $conn->close();
    }
}
