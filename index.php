<?php
if ($_SERVER['SSL_TLS_SNI'] == 'teste.sicoobcredimata.com.br') {
    $url = 'https://teste.sicoobcredimata.com.br';
} else {
    $url = 'https://sicoobcredimata.coop.br/application';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $url; ?>/styles/config.css">
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="headerCredimata"></div>
    <div class="bodyCredimata"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var url = 'https://sicoobcredimata.coop.br/application';

        $.ajax({
            url: url + '/public/header',
            type: 'POST',
            data: {
                img: '/imgs/headers/17c156fe-fdcf-4a10-a4a3-9325c53d7daf.svg',
                color: '36ad9c',
                title: 'Nossa História'
            },
            success: function(response) {
                $('.headerCredimata').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });

        $.ajax({
            url: url + '/public/body',
            type: 'POST',
            data: {
                page: 'nossa_historia'
            },
            success: function(response) {
                $('.bodyCredimata').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    </script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</body>

</html>