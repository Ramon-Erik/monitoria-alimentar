<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar ocorrência</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
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
                <h1 class="titulo-center">Registrar ocorrência</h1>
            </div>
        </div>
        <section class="links">
        <form action="../../control/controle-ocorrencia.php" method="post">
        <div class="opcao serie">
            
            <div class="linha">
                <h3><label for="serieId">A ocorrência foi realizada por um aluno ou pelos funcionários?</label></h3>
            </div>
            <div class="radio-group">
            <label>
                <input type="radio" name="option" value="aluno">
                <span class="custom-radio"></span> Aluno
            </label>
            <label>
                <input type="radio" name="option" value="funcionario">
                <span class="custom-radio"></span> Funcionário
            </label>
            </div>       
        </div>
        <div class="area-btn">
            <input type="submit" value="Enviar" name="btn" class="btn mandar">
        </div>
        </section>
        </form>
    </main>
</body>
</html>