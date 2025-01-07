<?php

// Se não existir um cookie nome redireciona para o ínicio.
if (empty($_COOKIE['nome'])) {
    header("Location: ../index.php");
    exit();
}

class ContaBancaria {
    private $saldo;
    public $titular;
    public $mensagem;

    // Constrói e adiciona o nome ao titular, salvando o saldo para cada um titular diferente
    public function __construct($titular) {
        $this->titular = $titular;
        // armazena o nome do titular a variavel saldo_titular
        $cookieName = "saldo_{$this->titular}";
        // saldo vai receber o valor de cookieName, se não existir vai receber um número 0
        $this->saldo = isset($_COOKIE[$cookieName]) ? (float)$_COOKIE[$cookieName] : 0;
    }

    // Adiciona o valor do saldo ao cookieName
    public function depositar($valor) {
        $cookieName = "saldo_{$this->titular}";
        $this->saldo += $valor;
        setcookie($cookieName, $this->saldo, time() + (86400 * 30), "/");
        return $valor;
    }

    // Verifica se o valor que você está tentando sacar é maior do que o que você tem, se não for adiciona o saldo novo ao cookieName
    public function sacar($valor) {
        if ($valor > $this->saldo) {
            $this->mensagem = "Você não pode sacar um valor maior do que você tem.";
        } else {
            $this->saldo -= $valor;
            $cookieName = "saldo_{$this->titular}";
            setcookie($cookieName, $this->saldo, time() + (86400 * 30), "/");
        }
        return $this->saldo;
    }

    // Apresenta o valor do saldo.
    public function verSaldo() {
        return number_format($this->saldo, 2, ',', '.');
    }
}


// Instanciando a classe com o nome armazenado no cookie
$pessoa = new ContaBancaria($_COOKIE['nome']);

// Se o método de envio do formulario for POST, 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se tem algum valor no campo "adicionarValor", se tiver, execute a função depositar.
    if (!empty($_POST['adicionarValor'])) {
        $pessoa->depositar($_POST['adicionarValor']);
    }

    // Verifica se tem algum valor no campo "sacarValor", se tiver, execute a função Sacar.
    if (!empty($_POST['sacarValor'])) {
        $pessoa->sacar($_POST['sacarValor']);
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
    <div class="container containerConta">
        <header id="banner">
            <nav>
                <i class="fa-solid fa-bars"></i>
                <h3>PBANK</h3>
                <i class="fa-solid fa-location-pin"></i>                
            </nav>
            <div id="boasVindas">
                <!-- Pega o nome do Títular na váriavel. -->
                <p>Olá, <?=$pessoa->titular?></p>
                <span>Ag 4022 Cc 01091792-9</span>
            </div>
        </header>
        <div id="saldo">
            <i class="fa-solid fa-sack-dollar"></i>
            <p>Saldo disponível</p>
            <i class="fa-solid fa-chevron-down" id="chevron"></i>
        </div>
        <div id="saldoMostrar">
            <!-- Exibe o saldo do usuario -->
            <h1>R$ <?=$pessoa->verSaldo()?></h1>
        </div>
        <p>
            <!-- Se tiver alguma mensagem, exibe, se não, segue o baile -->
            <?php if (!empty($pessoa->mensagem)): ?>
                <?php echo $pessoa->mensagem; ?>
            <?php endif; ?>
        </p>
        <div class="footer">
            <form method="post">
                <input type="number" name="adicionarValor" id="adicionarValor" placeholder="Valor..">
                <input type="submit" value="Adicionar Valor">
            </form>
            <form method="post">
                <input type="number" name="sacarValor" id="sacarValor" placeholder="Valor..">
                <input type="submit" value="Sacar Valor">
            </form>
        </div>
    </div>

    <script src="../assets/interacoes.js"></script>
</body>
</html>
