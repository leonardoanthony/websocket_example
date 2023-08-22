<?php

session_start();

ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - WebSocket</title>
</head>
<body>
    <h2>Chat</h2>
    <p>Olá <span id="nome_usuario"><?= $_SESSION['usuario']; ?></span></p>

    <label for="mensagem">Nova mensagem:</label>
    <input type="text" name="mensagem" id="mensagem" placeholder="Digite a mensagem...">

    <input type="button" value="Enviar" onclick="enviar()">

    <br>
    <br>


    <span id="mensagem_chat"></span>



    <script>
        const mensagem_chat = document.querySelector('#mensagem_chat');
        const nome_usuario = document.querySelector('#nome_usuario').innerHTML;
        const mensagem = document.querySelector('#mensagem');

        mensagem.addEventListener('keypress', (e) => {
           if(e.code == 'Enter'){
             enviar();
           }
        })



        const ws = new WebSocket('ws://localhost:8080');

        ws.onopen = (e) => {
            console.log('Conectado');
        }

        ws.onmessage = (mensagem_recebida) => {
            let resultado = JSON.parse(mensagem_recebida.data);

            mensagem_chat.insertAdjacentHTML('beforeEnd', `${resultado.mensagem}`);
        }


        const enviar = () => {
            

            let dados = {
                mensagem: `${nome_usuario}: ${mensagem.value} <br>`,
                
            }

            ws.send(JSON.stringify(dados));

            mensagem_chat.insertAdjacentHTML('beforeEnd', `${nome_usuario}: ${mensagem.value} <br>`);

            mensagem.value = '';
        }
    </script>
</body>
</html>