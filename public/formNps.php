<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');
$conn1 = dataBaseConn3(); // base colaboradores
$conn2 = dataBaseConn();  // base agencia
if (isset($_GET['pa'])) {
    $pa = $_GET['pa'];
    // Captura os dados do usuário com base no PA
    $userData = getUser($pa, 'agency');


    // Consulta no primeiro banco de dados
    $query1 = "SELECT * FROM sur_colaboradores WHERE pa = '$pa'";
    $result1 = $conn1->query($query1);


    $query2 = "SELECT * FROM usr_agencies WHERE pa = '$pa'";
    $result2 = $conn2->query($query2);

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

    // Acessar os dados combinados
    /*   foreach ($colaboradores as $colaborador) {
        if (isset($colaborador['nameColab'])) {
            echo $colaborador['nameColab'];
        } 
        else{
            echo "colaborador nao existe";
        }
    }*/
} else {
    die('PA não informado.');
}

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validação adicional do CPF
    if (preg_match("/^\d{3}\.\d{3}\.\d{3}-\d{2}$/", $cpfAssoc)) {
        $cpfAssoc = $_POST['cpfAssoc'];
        $pa = $_POST['pa'];
        // Inserir no banco de dados
        //COMPLETAR!!!
        $conn = dataBaseConn3();
        $stmt = $conn->prepare("INSERT INTO sur_answers (cpfAssoc, nameAssoc, cpfCpnjColab, nameColab) VALUES (?, ?)");
        $stmt->bind_param("ss", $cpfAssoc, $nameAssoc,$cpfCpnjColab, $nameColab, $pa);
        $stmt->execute();
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Formato de CPF inválido.";
    }
}*/
?>
<script>
    $('#surveyForm').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '/apis/survey/surveyapi',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var response = data.response;
                if (response == "success") {
                    createToast('success', 'Operação salva', 1000);
                } else {
                    createToast('warning', 'Resposta não conhecida', 1000);
                }
            },
            error: function() {
                createToast('error', 'Erro ao salvar', 3000);
            }
        });
    });
</script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Atendimento ao Cooperado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: #35ad9d;
        }

        .container {
            width: 60%;
            height: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            box-sizing: border-box;

            h2 {
                text-align: center;
            }
        }

        .header {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .header img {
            width: 500px;
            height: auto;
            margin: 0 10px;
        }

        .layoutForm {
            padding: 5px;
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
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .formvalueSocOption,
        .formvalueAtendOption,
        .formvalueAtendCordiOption,
        .formvalueAtendProbabOption {
            display: inline-block;
            width: 9%;
            box-sizing: border-box;
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
            /* Cor da borda ao focar */
            box-shadow: 0 0 0 0.1rem #0d3541;
            /* Sombra ao focar */
        }

        .form-check-input:checked {
            background-color: #0d3541;
            /* Cor de fundo quando selecionado */
            border-color: #0d3541;
            /* Cor da borda quando selecionado */
        }

        /* Estilos responsivos */
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 10px;

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
    <div class="container">
        <div class="header">
            <img src="../imgs/survey/marcasicoob.png" class="img-fluid" alt="">
        </div>
        <div class="layoutForm">
            <h2>PESQUISA DE ATENDIMENTO AO COOPERADO</h2>
            <form action="teste.php" method="post" id="surveyForm">
                <div class="form-group">
                    <label for="cpfAssoc">CPF: <span class="required">*</span></label>
                    <input type="text" id="cpfAssoc" class="form-control" name="cpfAssoc" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Formato xxx.xxx.xxx-xx">
                </div>

                <div class="form-group">
                    <label for="nameAssoc">Nome: <span class="optional">(opcional)</span></label>
                    <input type="text" id="nameAssoc" class="form-control" name="nameAssoc">
                </div>

                <p>Os dados informados nesse formulário serão utilizados para elaboração do perfil de associados. Para saber mais sobre como tratamos seus dados pessoais, por favor, acesse nossa Política de Privacidade disponível em:
                    <a href="https://www.sicoob.com.br/lgpd">www.sicoob.com.br/lgpd</a>
                </p>

                <div class="form-group">
                    <label for="agenciaAssoc">Agência:</label>
                    <input type="text" id="agencia" class="form-control" name="agencia" value="<?php echo htmlspecialchars($agencyName); ?>" readonly disabled>
                </div>

                <div class="form-group">
                    <label for="nameColab">Nome do Atendente:</label>
                    <select id="nameColab" class="form-control" name="nameColab">
                        <option value="" selected disabled>Selecione</option>
                        <?php
                        foreach ($colaboradores as $colaborador) {
                            echo "<option value='{$colaborador['nameColab']}'>{$colaborador['nameColab']}</option>";
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

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>