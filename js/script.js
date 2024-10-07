function receberMSG(){
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

//Procura por mensagens
setInterval(()=>{
    receberMSG()
}, 3000)