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
                <h1 class="titulo-center">Avaliação diária da comida</h1>
            </div>
        </div>
        <form action="../control/controle-index.php" method="post">
            <div class="opcoes">
                <div class="opcao serie">
                    <div class="linha">
                        <h2><label for="serieId">Informe sua série</label></h2>
                    </div>
                    <select class="minimal" name="serie" id="serieId">
                        <option value="null-serie">Selecione</option>
                        <optgroup label="Enfermagem">
                            <option value="1a">1° ano</option>
                            <option value="2a">2° ano</option>
                            <option value="3a">3° ano</option>
                        </optgroup>
                        <optgroup label="Informática">
                            <option value="1b">1° ano</option>
                            <option value="2b">2° ano</option>
                            <option value="3b">3° ano</option>
                        </optgroup>
                        <optgroup label="Meio Ambiente">
                            <option value="1m">1° ano</option>
                            <option value="2m">2° ano</option>
                            <option value="3m">3° ano</option>
                        </optgroup>
                        <optgroup label="Admnistração">
                            <option value="1ad">1° ano</option>
                            <option value="2ad">2° ano</option>
                            <option value="3ad">3° ano</option>
                        </optgroup>
                        <optgroup label="Edificações">
                            <option value="1d">1° ano</option>
                            <option value="2d">2° ano</option>
                            <option value="3d">3° ano</option>
                        </optgroup>
                    </select>
                </div>
                <div class="opcao horario">
                    <div class="linha">
                        <h2><label for="horarioId">O que será avaliado?</label></h2>
                    </div>
                    <select class="minimal" name="horario" id="horarioId">
                        <option value="null-horario">Selecione</option>
                        <option value="lm">Lanche da manhã</option>
                        <option value="al">Almoço</option>
                        <option value="lt">Lanche da tarde</option>
                    </select>
                </div>
            </div>
            <div class="linha">
                <h2>Como foi o almoço hoje?</h2>
            </div>
            <div class="linha label">
                <label for="radio-bom" class="label-emoji">&#128513;</label>
                <input type="radio" name="satisfacao" id="radio-bom" value="bom" required>
                <!-- <label for="radio-regular" class="label-emoji">&#128528;</label>
                <input type="radio" name="satisfacao" id="radio-regular" value="regular" required> -->
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