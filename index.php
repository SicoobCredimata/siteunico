<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://<?php echo $_SERVER['SCRIPT_URI']; ?>styles/config.css">
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="headerCredimata"></div>









    <?php
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
    ?>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $.ajax({
            url: 'https://<?php echo $_SERVER['SCRIPT_URI']; ?>public/header',
            type: 'POST',
            data: {
                img: 'one',
                title: 'Nossa História'
            },
            success: function(response) {
                $('.headerCredimata').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    </script>
</body>

</html>