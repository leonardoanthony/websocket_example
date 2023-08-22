<?php

session_start();

ob_start();

if(isset($_POST['acessar'])){
    $_SESSION['usuario'] = $_POST['usuario'];

    header("Location: chat.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - WebSocket</title>
</head>
<body>
    <h2>Acessar o chat</h2>

    <form action="" method="POST">
        <input type="text" required name="usuario" placeholder="Digite seu nome...">
        <input type="submit" name="acessar" value="Acessar">
    </form>



</body>
</html>