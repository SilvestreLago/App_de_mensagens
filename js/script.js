// MENSAGEM PRIVADA
function receberMSGP(){
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    // Cria uma nova requisição AJAX
    const xhr = new XMLHttpRequest()
    xhr.open('POST', './php/mostrar_P.php?id=' + id, true)

    // Titulo da requisição POST
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('chat-container').innerHTML =  xhr.responseText
        }
    }

    //Pega nome e defini os dados para envio
    var mensagem = `OK`
    // Envia os dados
    xhr.send(mensagem)

}

//MENSAGEM PÚBLICA
function receberMSG(){
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    // Cria uma nova requisição AJAX
    const xhr = new XMLHttpRequest()
    xhr.open('POST', './php/mostrar.php', true)

    // Titulo da requisição POST
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('chat-container').innerHTML =  xhr.responseText
        }
    }

    //Pega nome e defini os dados para envio
    var mensagem = `OK`
    // Envia os dados
    xhr.send(mensagem)

}

function msg(){
    if(window.location.pathname === '/sites/App_de_mensagens/chat_P.php'){
        receberMSGP()
    } else{
        receberMSG()
    }
}
//Procura por mensagens
setInterval(()=>{
    msg()
}, 3000)