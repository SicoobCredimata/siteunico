<?php
require_once('../../scripts/php/functions.php');
header('access-control-allow-origin: *');

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
            'diretoria@sicoobcredimata.com.br',
            'Diretoria Sicoob Credimata'
        ]
    ],
    'cc' => [
        [
            'luciana.anjos@sicoobcredimata.com.br',
            'Luciana Pires'
        ],
        [
            'gabriella.carraro@sicoobcredimata.com.br',
            'Gabriella Carraro'
        ]
    ],
    'files' => [],
    'mail' => [
        'Sugestão Assemblear',
        "$emailBody",
        'notHtml'
    ]
));

echo "Sugestão enviada com sucesso!";
