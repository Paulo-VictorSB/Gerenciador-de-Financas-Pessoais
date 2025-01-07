<?php 
// Inicia a sessão para armazenar os dados
session_start();
// Se o formulario for enviado via post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preciso saber se o campo nome está com algum valor dentro
    if (!empty($_POST['nome'])) {
        // se for verdadeiro, eu crio o cookie "nome" e armazeno o valor de nome no mesmo.
        setcookie('nome', $_POST['nome'], time() + 3600, "/");
        // encaminho para a página principal
        header("Location: interface.php");
        // encerro o script
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pbank - Seu banco favorito do Momento</title>
    <link rel="shortcut icon" href="banner.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <i class="fa-solid fa-bars"></i>
                <h3>PBANK</h3>
                <i class="fa-solid fa-location-pin"></i>
            </nav>
        </header>
        <form class="logarContainer" method="post" action="">
            <h3>Acessar a sua conta: </h3>
            <input type="text" name="nome" id="nome" placeholder="Seu nome aqui.." required minlength="5" maxlength="20">
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
