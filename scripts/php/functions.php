<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

function sendMail($data)
{ //ENVIAR EMAIL DE LOGIN
    //*
    include_once('../../libs/phpmailer/src/PHPMailer.php');
    include_once('../../libs/phpmailer/src/SMTP.php');
    include_once('../../libs/phpmailer/src/Exception.php');
    //*/

    $mail = new PHPMailer(true);

    try {
        //CONFIGURAÇÕS DO SERVIDOR
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();
        $mail->Host       = base64_decode("YnIxMTIuaG9zdGdhdG9yLmNvbS5icg==");
        $mail->SMTPAuth   = true;
        $mail->Username   = base64_decode("YXBwQHNpY29vYmNyZWRpbWF0YS5jb29wLmJy");
        $mail->Password   = base64_decode("U2ljb29iQDg0NTM0ODU3YTEy");

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $mail->Port       = "465";

        //CONFIGURAÇÕES DE ENVIO
        $mail->setFrom(
            base64_decode("YXBwQHNpY29vYmNyZWRpbWF0YS5jb29wLmJy"),
            "Credimata Analytics"
        );

        if (count($data['to']) > 0) { //ENVIOS
            foreach ($data['to'] as $to) {
                $mail->addAddress(
                    $to[0],
                    $to[1]
                );
            }
        }

        if (count($data['cc']) > 0) { //CÓPIAS
            foreach ($data['cc'] as $cc) {
                $mail->addCC(
                    $cc[0],
                    $cc[1]
                );
            }
        }

        if (count($data['files']) > 0) { //ANEXOS
            foreach ($data['files'] as $file) {
                $mail->addAttachment($file);
            }
        }

        $mail->addReplyTo( //RESPONDER PARA
            "inteligencia@sicoobcredimata.com.br",
            "INTELIGENCIA COMPETITIVA SICOOB CREDIMATA"
        );

        //CONTEÚDO
        $document = "<div align='center' style='background-color: #003641; border-radius: 8px 8px 8px 8px'>
        <img src='cid:logoMail' height='100px' style='object-fit: contain;'></div>
        <div align='center' style='background-color: #ffff; color: #1d1d1d;border-radius: 8px;'> 
        <h1>{$data['mail'][0]}</h1> 
        {$data['mail'][1]}
        <br>" . "<p><a href='https://app.sicoobcredimata.com.br'>Credimata Analytics</a></p>
        </div>";

        $mail->isHTML(true);
        //$mail->addEmbeddedImage('./imgs/system/logo/logo_aln_clara.png', 'logoMail');
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['mail'][0];
        $mail->Body    = nl2br($document);
        $mail->AltBody = $data['mail'][2];
        $mail->setLanguage('pt-br', $_SERVER['DOCUMENT_ROOT'] . '/libs/phpmailer/language/phpmailer.lang-pt_br.php');

        $mail->send();

        /*
        $example = array(
            'to' => [
                [
                    'marcus.geraldino@sicoobcredimata.com.br',
                    'Marcus Gabriel Xavier'
                ],
                [
                    'marcus.geraldino@sicoobcredimata.com.br',
                    'Marcus Gabriel Xavier'
                ]
            ],
            'cc' => [
                [
                    'marcusgx45@gmail.com',
                    'Marcus Gabriel Xavier Geraldino'
                ],
                [
                    'marcusggx223@gmail.com',
                    'Marcus Gabriel Xavier Geraldino'
                ]
            ],
            'files' => [
                '/var/www/error_php.log'
            ],
            'mail' => [
                'subject',
                'html',
                'notHtml'
            ]
        );
        //*/
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
