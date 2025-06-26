<?php
header('access-control-allow-origin: *');
if ($_SERVER['SSL_TLS_SNI'] == 'teste.sicoobcredimata.com.br') {
    $url = 'https://teste.sicoobcredimata.com.br';
} else {
    $url = 'https://sicoobcredimata.coop.br/application';
}
$uuid = "8b3ef3de-fb73-4586-9010-542d264d4e73.pdf";
?>
<div class="bodyItensCredimata">
    <div class="itenCredimata">
        <div>
            <i class="fa-solid fa-file-lines fa-2xl"></i>
            <span style="margin-left: 10px;">Relatório de Gestão 2024</span>
        </div>
        <div class="itensCredimataActions">
            <i class="fa-solid fa-download" onclick="downloadCredimata()"></i>
            <i class="fa-solid fa-eye" onclick="openCredimata()"></i>
        </div>
    </div>
</div>
<script>
    function downloadCredimata() {
        let url = 'https://84v1v7-my.sharepoint.com/personal/marcus_xavier_bunnytech_com_br/_layouts/15/download.aspx?SourceUrl=%2Fpersonal%2Fmarcus%5Fxavier%5Fbunnytech%5Fcom%5Fbr%2FDocuments%2Fsicoobcredimata%2F8b3ef3de%2Dfb73%2D4586%2D9010%2D542d264d4e73%2Epdf';
        let link = document.createElement('a');
        link.href = url;
        link.download = 'Relatório de Gestão 2024.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function openCredimata() {
        let url = 'https://84v1v7-my.sharepoint.com/personal/marcus_xavier_bunnytech_com_br/Documents/sicoobcredimata/8b3ef3de-fb73-4586-9010-542d264d4e73.pdf';
        window.open(url, '_blank');
    }
</script>
<style>
    .bodyItensCredimata {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 20px;

        .itenCredimata {
            width: 80%;
            height: 100px;
            display: flex;
            justify-content: space-between;
            padding: 5px 20px;
            align-items: center;
            background-color: #003641;
            box-shadow: 3px 3px 10px 3px #dddddd;
            color: #ffff;
            border-radius: 10px;

            .itensCredimataActions {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                font-size: 22px;

                i {
                    cursor: pointer;

                }
            }
        }
    }
</style>