/*==================================================================
    NAME: BIBLIOTECA TOAST V2.1.3
    AUTHOR: MARCUS GABRIEL XAVIER GERALDINO
    DATE: 14/10/2024
==================================================================*/
/* ================= TUTORIAL DE UTILIZAÇÃO =================
    CERTIFIQUE-SE DE INCLUIR TODOS AS DEPENDENCIAS
    toast.js
    toast.css

    CERTIFIQUE-SE QUE A ELEMENTO HTML ESTEJA ABAIXO DO BODY
    DA SUA PÁGINA
    <ul class="notificationsUl"></ul>

    CHAMAR O OBJETO TOAST ATRAVÉS DA FUNÇÃO ABAIXO
    createToast('tipo_toast','texto_toast','tempo')

    tipo_toast = 'success', 'error', 'warning', 'info'
    texto_toast = 'texto personalizado para chamada'
    tempo = tempo de duração em milisegundos (number)
*/
function createToast(type, text, time) {
    //ESTILOS DE ICONE PARA TOAST
    if (type == 'success') {
        var icon = 'fa-circle-check';
    } else if (type == 'error') {
        var icon = 'fa-circle-xmark';
    } else if (type == 'warning') {
        var icon = 'fa-triangle-exclamation';
    } else if (type == 'info') {
        var icon = 'fa-triangle-exclamation';
    }

    //CRIANDO OBJETO DE NOTIFICAÇÕES
    const notifications = document.querySelector(".notificationsUl");

    //REMOVER TOAST
    const removeToast = (toast) => {
        if (toast.timeoutId) clearTimeout(toast.timeoutId); // Clearing the timeout for the toast
        setTimeout(() => toast.classList.add("hide"), time); // Removing the toast after 500ms
        setTimeout(() => toast.remove(), (time + 380));
    }

    //VARIAVEL DE CLASSE CSS
    var style = document.createElement('style');
    style.innerHTML = `
    .toastLi::before {
        position: absolute;
        content: "";
        height: 3px;
        width: 100%;
        bottom: 0px;
        left: 0px;
        animation: progress ${time + 'ms'} linear forwards;
     }
    `;

    //DEFININDO PADRÕES PARA TOAST
    const toast = document.createElement('li');
    toast.className = 'toastLi ' + type;
    toast.innerHTML = `<div class="column">
                     <i class="fa-solid ${icon}"></i>
                     <span>${text}</span>
                  </div>
                  <i class="fa-solid fa-xmark toastbtn" onclick="removeToast(this.parentElement)"></i>`;
    toast.appendChild(style);
    notifications.appendChild(toast);
    toast.timeoutId = setTimeout(() => removeToast(toast), type.time);
}

//BOTÃO PARA REMOVER TOAST
const removeToast = (toast) => {
    toast.classList.add("hide");
    if (toast.timeoutId) clearTimeout(toast.timeoutId); // Clearing the timeout for the toast
    setTimeout(() => toast.remove(), 500); // Removing the toast after 500ms
}