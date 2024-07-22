<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php/*
    session_start(); 
    if (!isset($_SESSION['login'])) {
        echo '<script>alert("Faça login para ter acesso as funções de admin!")</script>';
        header('location: login.php');
    }*/
    ?>
    <header></header>
    <main>
        <div class="cabecalho">
            <div class="linha-cab">
                <h1 class="titulo-center">Painel de Controle</h1>
            </div>
        </div>
        <section class="links">
            <div class="linha">
                <h2 class="titulo-center">O que deseja fazer?</h2>
            </div>
            <div class="link">
                <div class="button"><a href="cardapio/lanche-manha.php" class="icone"> <span class="material-icons">note_alt</span></a></div>
                <div class="texto-func">
                    <a href="cardapio/lanche-manha.php"><h4>Registrar o lanche da manhã</h4></a>
                    <p>Informe o cadápio que compõe o lanche da manhã.</p>
                </div>
            </div>
            <div class="link">
                <div class="button"><a href="cardapio/almoco.php" class="icone"> <span class="material-icons">note_alt</span></a></div>
                <div class="texto-func">
                    <a href="cardapio/almoco.php"><h4>Registrar o almoço do dia</h4></a>
                    <p>Informe o cadápio que compõe o almoço do dia.</p>
                </div>
            </div>
            <div class="link">
                <div class="button"><a href="cardapio/lanche-tarde.php" class="icone"> <span class="material-icons">note_alt</span></a></div>
                <div class="texto-func">
                    <a href="cardapio/lanche-tarde.php"><h4>Registrar o lanche da tarde</h4></a>
                    <p>Informe o cadápio que compõe o lanche da tarde.</p>
                </div>
            </div>
            <div class="link">
                <div class="button"><a href="ocorrencia.php" class="icone"> <span class="material-icons">note_alt</span></a></div>
                <div class="texto-func">
                    <a href="ocorrencia.php"><h4>Registrar uma ocorrência</h4></a>
                    <p>Informe algo de errado que aconteceu durante um dos intervalos.</p>
                </div>
            </div>
            <div class="link">
                <div class="button"><a href="relatorio/index.php" class="icone"> <span class="material-icons">note_alt</span></a></div>
                <div class="texto-func">
                    <a href="relatorio/index.php"><h4>Gerar relatório</h4></a>
                    <p>Peça um relatório dos dados do site.</p>
                </div>
            </div>
            <div class="link">
                <div class="button"><a href="../control/control-login.php?exit=true" class="icone"> <span class="material-icons">logout</span></a></div>
                <div class="texto-func">
                    <a href="../control/control-login.php?exit=true"><h4>Sair</h4></a>
                    <p>Clique aqui para sair da conta de admin.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>