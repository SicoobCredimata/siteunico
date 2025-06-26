<?php
require_once('../scripts/php/functions.php');
$conn = dataBaseConn(true);  // base agencia
if (isset($_GET['pa'])) {
    $pa = $_GET['pa'];

    // Consulta no primeiro banco de dados
    $query1 = "SELECT * FROM sur_colaboradores WHERE pa = '$pa' AND (
        cargo LIKE '%AGENTE ATENDIMENTO%' OR 
        cargo LIKE '%AGENTE DE ATENDIMENTO%' OR 
        cargo LIKE '%GERENTE DE PA%' OR 
        cargo LIKE '%GERENTE DE AGENCIA%' OR 
        cargo LIKE '%GERENTE DE RELACIONAMENTO%' OR
        cargo LIKE '%estagiário%' OR
        cargo LIKE '%ESTAGIÁRIO%'
    )";
    $result1 = $conn->query($query1);

    $query2 = "SELECT * FROM usr_agencies WHERE pa = '$pa'";
    $result2 = $conn->query($query2);

    // Combinação dos resultados
    $colaboradores = [];
    $agencyName = '';
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            $colaboradores[] = $row1;
        }
    }

    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $colaboradores[] = $row2;
            $agencyName = $row2['city']; // Obtém o nome da agência
        }
    }
} else {
    die('PA não informado.');
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Atendimento ao Cooperado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../libs/toast/toast.css">
    <link rel="shortcut icon" href="../imgs/system/icons/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 10px;
            background-image: url('../libs/background/fundo_claro.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            background-color: white;
            box-sizing: border-box;
            border: none !important;
            border-radius: 10px !important;
        }

        .header {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .header img {
            width: 100%;
            height: auto;
            border: none;
            border-radius: 8px;
        }

        .layoutForm {
            padding: 20px;
            justify-content: center;
            align-items: center;
            text-align: justify;

        }

        .required {
            color: red;
        }

        .optional {
            color: gray;
            font-size: 0.9em;
        }

        .form-group,
        .button {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            box-sizing: border-box;
        }

        .formvalueSoluc,
        .formvalueAtend,
        .formvalueAtendCordi,
        .formvalueAtendProbab {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .formvalueSocOption,
        .formvalueAtendOption,
        .formvalueAtendCordiOption,
        .formvalueAtendProbabOption {
            display: inline-block;
            width: calc(100% / 11 - 10px);
            box-sizing: border-box;
            text-align: center;
            margin: 0 5px;
        }

        .ButtonSubmit {
            display: flex;
            justify-content: center;
        }

        .defaultButton {
            background-color: #0d3541;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            font-size: 1.2em;
            box-sizing: border-box;
        }

        .defaultButton:hover {
            background-color: #00ae9d;
        }

        .form-control:focus {
            border-color: #0d3541;
            box-shadow: 0 0 0 0.1rem #0d3541;
        }

        .form-check-input:checked {
            background-color: #0d3541;
            border-color: #0d3541;
        }

        @media (max-width: 600px) {
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 0;
                padding: 0px;
                background-color: #35ad9d
            }

            .container {
                width: 100%;
                padding: 10px;

            }

            .header img {
                width: 100vw;
                height: auto;
                border: none;
                border-radius: 8px;
            }

            .form-group input[type="text"],
            .form-group select,
            .form-group textarea {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>


<body>
    <ul class="notificationsUl"></ul>
    <div class="container">
        <div class="header">
            <img src="../libs/brand/JPG/PESQUISA2.jpg" class="img-fluid" alt="">
        </div>
        <div class="layoutForm">
            <form action="teste.php" method="post" id="surveyForm">
                <div class="form-group">
                    <label for="cpfCnpjAssoc">CPF/CNPJ: <span class="required">*</span></label>
                    <input type="text" id="cpfCnpjAssoc" class="form-control" name="cpfCnpjAssoc" required>
                </div>
                <p>Os dados informados nesse formulário serão utilizados para elaboração do perfil de associados. Para saber mais sobre como tratamos seus dados pessoais, por favor, acesse nossa Política de Privacidade disponível em:
                    <a href="https://www.sicoob.com.br/lgpd">www.sicoob.com.br/lgpd</a>
                </p>
                <div class="form-group">
                    <label for="agenciaAssoc">Agência:</label>
                    <input type="text" id="agencia" class="form-control" name="agencia" value="<?php echo htmlspecialchars($agencyName); ?>" readonly disabled>
                </div>

                <div class="form-group">
                    <label for="nameColab">Nome do Atendente: <span class="required">*</span></label>
                    <select id="nameColab" class="form-control" name="nameColab" required>
                        <option value="" selected disabled>Selecione</option>
                        <?php
                        foreach ($colaboradores as $colaborador) {
                            echo "<option value='{$colaborador['id']}'>{$colaborador['nameColab']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="valueSoluc">Em uma escala de 0 a 10, quanto o atendente solucionou a sua demanda? (Sendo 0 a pior e 10 a melhor nota) <span class="required">*</span></label>
                    <div class="formvalueSoluc">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <div class="formvalueSocOption">
                                <input class="form-check-input" type="radio" name="valueSoluc" id="valueSoluc<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                <label class="form-check-label" for="valueSoluc<?php echo $i; ?>"><?php echo $i; ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="valueAtend">Em uma escala de 0 a 10, avalie se o atendente demonstrou domínio técnico ao prestar o atendimento. <span class="required">*</span></label>
                    <div class="formvalueAtend">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <div class="formvalueAtendOption">
                                <input class="form-check-input" type="radio" name="valueAtend" id="valueAtend<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                <label class="form-check-label" for="valueAtend<?php echo $i; ?>"><?php echo $i; ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="valueCordi">Em uma escala de 0 a 10, com qual nota você avalia a cordialidade de quem prestou o atendimento? <span class="required">*</span></label>
                    <div class="formvalueAtendCordi">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <div class="formvalueAtendCordiOption">
                                <input class="form-check-input" type="radio" name="valueCordi" id="valueCordi<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                <label class="form-check-label" for="valueCordi<?php echo $i; ?>"><?php echo $i; ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="valueProbab">Em uma escala de 0 a 10, qual a probabilidade de você indicar o Sicoob Credimata para um amigo? <span class="required">*</span></label>
                    <div class="formvalueAtendProbab">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <div class="formvalueAtendProbabOption">
                                <input class="form-check-input" type="radio" name="valueProbab" id="valueProbab<?php echo $i; ?>" value="<?php echo $i; ?>" required>
                                <label class="form-check-label" for="valueProbab<?php echo $i; ?>"><?php echo $i; ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comments">Espaço reservado para sugestões, elogios ou reclamações:</label>
                    <textarea name="commentsAssoc" class="form-control" id="commentsAssoc"></textarea>
                </div>

                <div class="ButtonSubmit">
                    <button type="submit" id="submitSurvey" class="defaultButton">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='../libs/toast/toast.js'></script>
    <script>
        $(document).ready(function() {
            $('#surveyForm').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                formData.append('communication', 'submitSurvey');
                formData.append('pa', '<?= $pa ?>');

                $.ajax({
                    url: '../apis/survey/surveyapi',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var response = data.response;
                        if (response == "success") {
                            createToast('success', 'Operação salva', 1000);
                            setTimeout(function() {
                                updateContainer();
                            }, 1000); // Aguarda 1 segundo antes de redirecionar
                        } else if (response == "previouslyregistered") {
                            createToast('warning', 'Você já respondeu a pesquisa', 1000);
                        } else {
                            createToast('warning', 'Resposta não conhecida', 1000);
                        }
                    },
                    error: function() {
                        createToast('error', 'Erro ao salvar', 3000);
                    }
                });
            });
        });

        function updateContainer() {
            $.ajax({
                url: '../modules/ThankyouPage.html',
                type: 'GET',
                success: function(data) {
                    $('.container').html(data);
                },
            });
        }

        $('#cpfCnpjAssoc').on('blur', function() {
            var valor = $(this).val().replace(/\D/g, '');
            if (valor.length === 11) {
                $('#type').val('PF');
                $(this).mask('000.000.000-00');
            } else if (valor.length === 14) {
                $('#type').val('PJ');
                $(this).mask('00.000.000/0000-00');
            } else {
                $(this).unmask();
            }
        });
    </script>
</body>

</html>