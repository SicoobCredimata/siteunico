<?php
$img = $_POST['img'];
$title = $_POST['title'];

?>
<div class="imageBackgroundCredimata">
    <div class="containerMenuCredimata">
        <span class="menuNavigationCredimata"><i class="fa-solid fa-house-chimney"></i> Sicoob Credimata <i class="fa-solid fa-caret-right"></i> Nossa História</span>
        <div class="containerTitleSicoobCredimata">
            <span class="titleCredimata"><?php echo $title; ?></span>
        </div>

    </div>

</div>
<style>
    .imageBackgroundCredimata {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: calc(100vh * 0.35);
        background-image: url('./libs/brand/predio_sicoob.svg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        .containerMenuCredimata {
            height: 70%;
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 20px;

            .containerTitleSicoobCredimata {
                background-color: #00AE9D;
                border-radius: 15px;
                width: 100%;
                height: 50%;

                .titleCredimata {
                    padding-left: 30px;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    font-size: 2rem;
                    color: #ffffff !important;
                }
            }

            .menuNavigationCredimata {
                padding-left: 10px;
                color: #ffffff !important;

            }
        }
    }
</style>