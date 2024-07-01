<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre para votar mais</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="https://icons.iconarchive.com/icons/aha-soft/desktop-buffet/48/Steak-icon.png" type="png">
</head>
<body>
    <header></header> 
    <main>
        <div class="cabecalho">
            <div class="linha-cab">
                <h1>Faça login para votar mais vezes</h1>
            </div>
        </div>
        <form action="../control/controle-login.php" method="post">
            <div class="linha" style="margin-bottom: 5px;">
                <label for="senhaId"><strong>Informe a senha</strong></label>
            </div>
            <div class="linha" style="margin-top: 5px;">
               <input type="password" name="senha" id="senhaId">
            </div>
            <div class="area-btn">
                <input type="submit" value="Enviar" name="btn-login" class="btn mandar"/>
                <input type="reset" value="Limpar" class="btn limpar">
            </div>
        </form>
    </main>
    <footer>
        <p>Site desenvolvido por <a href="https://instagram.com/29erik_" target="_blank" rel="noopener noreferrer">Ramon Erik (Informática 2022-2024)</a></p>
    </footer>
</body>
</html>