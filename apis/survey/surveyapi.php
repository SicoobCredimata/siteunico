<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Sao_Paulo');
$dateTimeStr = date('Y-m-d H:i');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once('./scripts/php/functions.php');
    $communication = trim($_POST['communication']);


    if ($communication == 'submitSurvey') {
        $conn = dataBaseConn();
        $pa = isset($_POST['pa']) ? trim($_POST['pa']) : '';
        $cpfCnpjAssoc = isset($_POST['cpfCnpjAssoc']) ? trim($_POST['cpfCnpjAssoc']) : '';
        $nameColab = isset($_POST['nameColab']) ? trim($_POST['nameColab']) : '';
        $valueSoluc  = isset($_POST['valueSoluc']) ? trim($_POST['valueSoluc']) : '';
        $valueAtend = isset($_POST['valueAtend']) ? trim($_POST['valueAtend']) : '';
        $valueCordi = isset($_POST['valueCordi']) ? trim($_POST['valueCordi']) : '';
        $valueProbab = isset($_POST['valueProbab']) ? trim($_POST['valueProbab']) : '';
        $commentsAssoc = isset($_POST['commentsAssoc']) ? trim($_POST['commentsAssoc']) : '';
        $dateTimeStr = date('Y-m-d H:i');

        // Validação básica dos dados: verifica se algum desses está vazio
        if (empty($cpfCnpjAssoc) || empty($nameColab) || $valueSoluc === '' || $valueAtend === '' || $valueCordi === '' || $valueProbab === '') {
            echo json_encode(['response' => 'error', 'message' => 'Campos obrigatórios não preenchidos']);
            exit;
        }
        // Verifica se o CPF ou CNPJ está no formato correto
        if (!preg_match("/^\d{3}\.\d{3}\.\d{3}-\d{2}$/", $cpfCnpjAssoc) && !preg_match("/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/", $cpfCnpjAssoc)) {
            echo json_encode(['response' => 'error', 'message' => 'CPF ou CNPJ inválido']);
            exit;
        }

        // Verifica se o CPF/CNPJ já enviou uma resposta nos últimos 10 minutos
        $checkQuery = $conn->prepare("SELECT dateComment FROM sur_answers WHERE cpfCnpjAssoc = ? ORDER BY dateComment DESC LIMIT 1");
        $checkQuery->bind_param("s", $cpfCnpjAssoc);
        $checkQuery->execute();
        $checkQuery->bind_result($lastDateComment);
        $checkQuery->fetch();
        $checkQuery->close();

        if ($lastDateComment) {
            $lastDateTime = new DateTime($lastDateComment);
            $currentDateTime = new DateTime($dateTimeStr);
            $interval = $currentDateTime->diff($lastDateTime);

            if ($interval->i < 10 && $interval->h == 0 && $interval->d == 0) {
                echo json_encode(['response' => 'previouslyregistered', 'message' => 'Você já respondeu a pesquisa']);
                exit;
            }
        }
        //Inserir os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO sur_answers (idPa, cpfCnpjAssoc, idColab, valueSoluc, valueAtend, valueCordi, valueProbab, commentsAssoc, dateComment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt->execute([$pa, $cpfCnpjAssoc, $nameColab, $valueSoluc, $valueAtend, $valueCordi, $valueProbab, $commentsAssoc, $dateTimeStr])) {
            $response = 'success';
            echo (json_encode(['date' => $dateTimeStr, 'response' => $response, 'message' => 'Alterações realizadas com sucesso']));
        } else {
            echo json_encode(['response' => 'error', 'message' => 'Erro ao salvar o formulário.']);
        }
        $stmt->close();
        $conn->close();
    }
}
