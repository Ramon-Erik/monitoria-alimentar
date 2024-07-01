<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satisfação Alimentar</title>
    <link rel="shortcut icon" href="https://icons.iconarchive.com/icons/aha-soft/desktop-buffet/48/Steak-icon.png" type="png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    session_start(); 
    if (isset($_SESSION['maquina']) and $_SESSION['maquina'] === 'n') {
        echo '<script>alert("tentativa de login falha")</script>';
    }
    ?> 
    <header></header> 
    <main>
        <div class="cabecalho">
            <div class="linha-cab">
                <h1>Avaliação semanal da comida</h1>
            </div>
        </div>
        <form action="../control/controle-index.php" method="post">
            <div class="linha">
                <h2>Como foi o almoço hoje?</h2>
            </div>
            <div class="linha label">
                <label for="radio-bom" class="label-emoji">&#128513;</label>
                <input type="radio" name="satisfacao" id="radio-bom" value="bom" required>
                <input type="radio" name="satisfacao" id="radio-regular" value="regular" required>
                <label for="radio-ruim" class="label-emoji">&#128577;</label>
                <input type="radio" name="satisfacao" id="radio-ruim" value="ruim" required>
            </div>
            <div class="area-btn">
                <input type="submit" value="Enviar" name="btn" class="btn mandar"/>
                <input type="reset" value="Limpar" class="btn limpar">
                <a href="login.php" class="btn mandar">Login</a>
            </div>
        </form>
    </main>
    <footer>
        <p>Site desenvolvido por <a href="https://instagram.com/29erik_" target="_blank" rel="noopener noreferrer">Ramon Erik (Informática 2022-2024)</a></p>
    </footer>
    <script src="js/script.js"></script>
</body>

</html>