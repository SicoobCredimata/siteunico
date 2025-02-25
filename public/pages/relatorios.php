<?php
require_once('../../scripts/php/functions.php');
$conn = dataBaseConn(true);





?>
<div class="containerMasterSicoobCredimata">
    <div class="containerSicoobCredimata">
        <div class="textAreaSicoobCredimata">
            <div class="titleSicoobCredimata">O que são os relatórios?</div>
            <div class="textCredimataCooperativismo">
                São documentos que apresentam informações financeiras detalhadas sobre a saúde financeira e o desempenho da cooperativa. Eles desempenham um papel crucial na tomada de decisões, na conformidade regulatória e na prestação de contas. Alguns dos relatórios contábeis mais comuns em instituições financeiras incluem: Balanço Patrimonial, Notas Explicativas, Relatórios de Gestão e Relatórios Regulatórios.<br><br>
                Eles promovem a transparência, a responsabilidade e a capacidade de tomar decisões bem fundamentadas, ajudando a manter a estabilidade e o sucesso a longo prazo da cooperativa.
            </div>
        </div>
        <div class="containerRelatorioSicoobCredimata">
            <?php
            $result = $conn->query("SELECT * FROM relatorios_topicos");
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;

                    echo "<div class='optionRelatorioSicoobCredimata' id='$i'>{$row['name']}</div>";
                    echo "<div id='option$i' class='relatorioSicoobCredimata' style='display: none;'>";

                    $result2 = $conn->query("SELECT * FROM relatorios_assuntos WHERE topic = '{$row['id']}'");
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            //substituir a caractere vazia
                            $name = str_replace(' ', '', $row['name']);
                            echo "<div class='buttonRelatorioYearSicoobCredimata' id='$name'>{$row2['name']}</div>";
                            echo "<div class='optionOpenRelatorioSicoobCredimata' id='$name{$row2['name']}' style='display: none;'>";
                            echo "<div class='buttonBackSicoobCredimata'>Voltar</div>";
                            echo "<div class='titleContainerYearSicoobCredimata'><span>{$row2['name']}</span></div>";
                            echo "<div class='containerDocumentsSicoobCredimata'>";
                            
                            $result3 = $conn->query(
                                "SELECT * FROM relatorios_documentos WHERE assuntId = '{$row2['id']}'"
                            );
                            while ($row3 = $result3->fetch_assoc()) {
                                echo "<div class='documentRegistradoSicoobCredimata'>";
                                echo "<div class='containerImagemSicoobCredimata'>";
                                echo "<div class='imagemSicoobCredimata' style='background-image: url(\"../../public/files/imgs/{$row3['img']}\");'>";
                                echo "<div class='buttonOpenDocumentSicoobCredimata'>ABRIR DOCUMENTO</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='containerDadosDocumentSicoobCredimata' style='background-image: url(\"../../public/files/figs/{$row3['background']}\");'>";
                                echo "<div class='titleDocumentSicoobCredimata'>{$row3['name']}</div>";
                                echo "<div class='buttonDownloadDocumentSicoobCredimata'>BAIXAR<i class='fa-solid fa-download'></i></div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "Nenhum resultado encontrado";
                    }
                    echo "</div>";
                }
            } else {
                echo "Nenhum resultado encontrado";
            }
            ?>

            <div class='optionRelatorioSicoobCredimata' id='4'>OUVIDORIA</div>
            <div id='option4' class='relatorioSicoobCredimata' style='display: none;'>
                <div class='buttonRelatorioYearSicoobCredimata'>2024</div>
                <div class='buttonRelatorioYearSicoobCredimata'>2025</div>
                <div class='optionOpenRelatorioSicoobCredimata' id='2024' style='display: none;'>
                    <div class='buttonBackSicoobCredimata'>VOLTAR</div>
                    <div class='titleContainerYearSicoobCredimata'>
                        <span>{$row2['name']}</span>
                    </div>
                    <div class="containerDocumentsSicoobCredimata">
                        <div class="documentRegistradoSicoobCredimata">
                            <div class="containerImagemSicoobCredimata">
                                <div class="imagemSicoobCredimata" style="background-image: url('../../public/files/imgs/caff5fbb-f110-4ffb-baf8-c5129476380a.jpg');">
                                    <div class="buttonOpenDocumentSicoobCredimata">ABRIR DOCUMENTO</div>
                                </div>
                            </div>
                            <div class="containerDadosDocumentSicoobCredimata" style="background-image: url('../../public/files/figs/28910ccc-20ef-400a-b65c-09db44887074.svg');">
                                <div class="titleDocumentSicoobCredimata">Relatório de Ouvidoria 2024</div>
                                <div class="buttonDownloadDocumentSicoobCredimata">BAIXAR<i class="fa-solid fa-download"></i></div>

                            </div>

                        </div>
                        <div class="documentRegistradoSicoobCredimata">
                            <div class="containerImagemSicoobCredimata">
                                <div class="imagemSicoobCredimata" style="background-image: url('../../public/files/imgs/caff5fbb-f110-4ffb-baf8-c5129476380a.jpg');">
                                    <div class="buttonOpenDocumentSicoobCredimata">ABRIR DOCUMENTO</div>
                                </div>
                            </div>
                            <div class="containerDadosDocumentSicoobCredimata" style="background-image: url('../../public/files/figs/28910ccc-20ef-400a-b65c-09db44887074.svg');">
                                <div class="titleDocumentSicoobCredimata">Relatório de Ouvidoria 2024</div>
                                <div class="buttonDownloadDocumentSicoobCredimata">BAIXAR<i class="fa-solid fa-download"></i></div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class='optionOpenRelatorioSicoobCredimata' id='2025' style='display: none;'>
            <div class='buttonBackSicoobCredimata'>voltar</div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    var id = 0;
    $('.optionRelatorioSicoobCredimata').click(function() {
        let idClicked = this.id;

        if (id === idClicked) {
            id = 0;
            $('.relatorioSicoobCredimata').slideUp();
        } else {
            id = idClicked;
            $('.relatorioSicoobCredimata').slideUp();
            $('#option' + id).slideDown();
        }


        $('.optionOpenRelatorioSicoobCredimata').slideUp();
        $('.buttonRelatorioYearSicoobCredimata').slideDown();
    });

    $('.buttonRelatorioYearSicoobCredimata').click(function() {
        let option = $(this).text();
        option = this.id + option;

        //alert(option);



        $('.buttonRelatorioYearSicoobCredimata').slideUp(function() {
            $('#' + option).slideDown();
        });
    });

    $('.buttonBackSicoobCredimata').click(function() {
        $('.optionOpenRelatorioSicoobCredimata').slideUp(function() {
            setTimeout(() => {
                $('.buttonRelatorioYearSicoobCredimata').slideDown();
            }, 400);
        });
    });
</script>
<style>
    .containerMasterSicoobCredimata {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;

        .containerSicoobCredimata {
            padding-top: 20px;
            width: 70%;
            background-color: #ffffff;
            height: 200vh;

            .containerRelatorioSicoobCredimata {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 50px;
                gap: 10PX;

                .relatorioSicoobCredimata {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-around;
                    width: 100%;
                    border: 2px solid #77b63c;
                    border-top: none;
                    border-radius: 8px;
                    margin-top: -30px;
                    padding: 30px 10px 30px 10px;
                    gap: 20px;
                    flex-wrap: wrap;

                    .optionOpenRelatorioSicoobCredimata {
                        width: 100%;
                        position: relative;

                        .titleContainerYearSicoobCredimata {
                            width: 100%;
                            text-align: center;
                            font-size: 1.7rem;
                            font-weight: bold;

                            span {
                                padding: 0% 15%;
                                height: 100%;
                                background-color: #003641;
                                color: #ffffff;
                                border-radius: 5px;
                                box-shadow: 3px 3px 10px 3px #dddddd;
                            }
                        }

                        .containerDocumentsSicoobCredimata {
                            width: 100%;
                            display: flex;
                            flex-direction: column;
                            gap: 20px;
                            padding-top: 30px;

                            .documentRegistradoSicoobCredimata {
                                display: flex;
                                flex-direction: row;
                                justify-content: center;
                                gap: 20px;

                                .containerImagemSicoobCredimata {
                                    width: 30%;

                                    .imagemSicoobCredimata {
                                        width: 100%;
                                        height: 500px;
                                        background-size: cover;
                                        background-position: center;
                                        border-radius: 8px;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: flex-end;

                                        .buttonOpenDocumentSicoobCredimata {
                                            width: 100%;
                                            height: 60px;
                                            background-color: #00AE9D;
                                            color: #ffffff;
                                            font-weight: bold;
                                            text-align: center;
                                            border-radius: 8px 8px 8px 8px;
                                            display: flex;
                                            flex-direction: column;
                                            justify-content: center;
                                            font-size: 1.2rem;
                                            transition: all 200ms linear;

                                            &:hover {
                                                background-color: #00796e;
                                                cursor: pointer;
                                                height: 150px;
                                            }
                                        }
                                    }
                                }

                                .containerDadosDocumentSicoobCredimata {
                                    width: 30%;
                                    background-image: url('../../public/files/figs/7701e425-5e84-4af3-ac3f-339d97e25fe6.svg');
                                    background-repeat: no-repeat;
                                    background-size: 50%;
                                    background-position: center;
                                    background-position-x: left;

                                    .titleDocumentSicoobCredimata {
                                        margin-top: 20px;
                                        width: 150%;
                                        height: 60px;
                                        font-size: 2rem;
                                        color: #003641;
                                        font-weight: bold;
                                        border-left: 8px solid #00AE9D;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        padding-left: 10px;
                                    }

                                    .buttonDownloadDocumentSicoobCredimata {
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        align-items: center;
                                        color: #ffffff;
                                        font-weight: bold;
                                        margin-top: 50px;
                                        width: 150px;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        background-color: #00AE9D;
                                        font-size: 1.2rem;
                                        border-radius: 8px;
                                        padding: 5px;
                                        transition: all 200ms linear;

                                        &:hover {
                                            cursor: pointer;
                                            background-color: #00796e;
                                        }
                                    }
                                }
                            }














                        }

                        .buttonBackSicoobCredimata {
                            top: 0;
                            position: absolute;
                            padding: 10px 30px;
                            font-weight: bold;
                            background-color: #00AE9D;
                            border-radius: 8px;
                            color: #ffffff;
                            transition: all 200ms linear;

                            &:hover {
                                cursor: pointer;
                                background-color: #00796e;
                            }
                        }
                    }

                    .buttonRelatorioYearSicoobCredimata {
                        background-color: #003641;
                        color: #ffffff;
                        font-weight: bold;
                        width: 30%;
                        height: 60px;
                        border-radius: 8px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.5rem;
                        cursor: pointer;
                    }
                }

                .optionRelatorioSicoobCredimata {
                    width: 100%;
                    height: 70px;
                    background-color: #77b63c;
                    border-radius: 15px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    color: #ffffff;
                    font-weight: bold;
                    font-size: 1.4rem;
                    padding-left: 15px;
                    cursor: pointer;
                }
            }

            .textAreaSicoobCredimata {
                width: 100%;

                .titleSicoobCredimata {
                    color: #00AE9D;
                    font-weight: bold;
                    font-size: 2rem;
                    padding-bottom: 20px;
                }

                .textCredimataCooperativismo {
                    text-align: justify;
                    font-size: 1.1rem;

                    br {
                        margin-bottom: 15px;
                    }

                    b {
                        color: #00AE9D;
                        font-weight: bold;
                    }
                }
            }
        }
    }
</style>