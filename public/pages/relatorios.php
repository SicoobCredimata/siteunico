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
            <div class="optionRelatorioSicoobCredimata" id="1">OUVIDORIA</div>
            <div id="option1" class="relatorioSicoobCredimata" style="display: none;">
                <div class="buttonRelatorioYearSicoobCredimata">2024</div>
                <div class="buttonRelatorioYearSicoobCredimata">2025</div>
                <div class="optionOpenRelatorioSicoobCredimata" id="2024" style="display: none;">
                    <div class="buttonBackSicoobCredimata">voltar</div>
                </div>
                <div class="optionOpenRelatorioSicoobCredimata" id="2025" style="display: none;">
                    <div class="buttonBackSicoobCredimata">voltar</div>
                </div>

            </div>
            <div class="optionRelatorioSicoobCredimata" id="2">DEMONSTRATIVOS FINANCEIROS</div>
            <div id="option2" class="relatorioSicoobCredimata" style="display: none;">
                este é um relatorio

            </div>
            <div class="optionRelatorioSicoobCredimata" id="3">POLÍTICAS INSTITUCIONAIS</div>
            <div id="option3" class="relatorioSicoobCredimata" style="display: none;">
                este é um relatorio

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
    });

    $('.buttonRelatorioYearSicoobCredimata').click(function() {
        let option = $(this).text();

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
                    padding: 45px 10px 30px 10px;
                    gap: 20px;
                    flex-wrap: wrap;

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