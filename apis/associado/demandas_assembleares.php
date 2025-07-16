<?php

require_once('../../scripts/php/functions.php');

$name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : "N/A";
$email = isset($_POST['email']) && $_POST['email'] !== '' ? $_POST['email'] : "N/A";
$agencia = isset($_POST['agencia']) && $_POST['agencia'] !== '' ? $_POST['agencia'] : "N/A";
$sugestao = isset($_POST['sugestao']) && $_POST['sugestao'] !== '' ? $_POST['sugestao'] : "N/A";

$emailBody = "<p>Sugestão assemblear registrada por <strong>{$name}</strong> ({$email})</p>
<p>Agência: <strong>{$agencia}</strong></p>
<p>Sugestão: <strong>{$sugestao}</strong></p>";

sendMail(array(
    'to' => [
        [
            'marcus.geraldino@sicoobcredimata.com.br',
            'Marcus Gabriel Xavier'
        ]
    ],
    'cc' => [
        [
            'marcusgx45@gmail.com',
            'Marcus Gabriel Xavier Geraldino'
        ]
    ],
    'files' => [],
    'mail' => [
        'Sugestão Assemblear',
        "$emailBody",
        'notHtml'
    ]
));
