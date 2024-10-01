function subirMSG() {
    // Pega o valor da caixa de texto 
    var msg = document.getElementById('message-input').value

    //Verifica se a mensagem está vazia
    if (msg === ''){
        alert('Por favor, insira uma mensagem.')
    }
    //Limpa o input
    const messageInput = document.getElementById('message-input');
    const messageText = messageInput.value.trim();
    if(messageText != ''){
        messageInput.value = "";
    }

    // Cria uma nova requisição AJAX
    const xhr = new XMLHttpRequest()
    xhr.open('POST', './php/subir.php', true)

    // Titulo da requisição POST
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    
    
    // Resposta
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('message-input').innerHTML =  xhr.responseText
        }
    }
    //Pega nome e defini os dados para envio
    nome = localStorage.getItem('nome')
    var mensagem = `msg=${msg}&nome=${nome}`
    // Envia os dados
    xhr.send(mensagem)

}

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
    nome = localStorage.getItem('nome')
    var mensagem = `nome=${nome}`
    // Envia os dados
    xhr.send(mensagem)

     // Resposta
}

function recebeNOME(nome){
    //Pede o nome do usuário
    nome = prompt('Qual o seu nome?').trim()

    //Força a escolha de um nome
    while(nome != '' || nome != null){
        alert('Necessário inserir nome.')
        nome = prompt('Qual o seu nome?').trim()
    }

    //Mostra nome na tela e adiciona em sessão
    document.getElementById('topo').innerHTML = `Bem-vindo(a): ${nome}`
    localStorage.setItem('nome', nome)
    
}

//Procura por mensagens
setInterval(()=>{
    receberMSG()
}, 2000)