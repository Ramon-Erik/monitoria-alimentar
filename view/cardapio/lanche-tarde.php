<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informar cardápio</title>
    <link rel="shortcut icon" href="https://icons.iconarchive.com/icons/aha-soft/desktop-buffet/48/Steak-icon.png" type="png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    session_start(); 
    if (!isset($_SESSION['login'])) {
        echo '<script>alert("Faça login")</script>';
        header('location: ../login.php');
    }
    ?>
    <header></header>
    <main>
        <div class="cabecalho">
            <div class="linha-cab">
                <h1>Informar o cardápio do lanche da tarde</h1>
            </div>
        </div>
        <form action="../../control/cardapio-lanche.php" method="post" autocomplete="off">
            <div class="grupo">
                <div class="linha">
                    <label for="dataId">Cardápio referente ao dia</label>
                </div>
                <div class="linha">
                    <input type="date" name="data" id="dataId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="refSolidaId">O que foi servido para comer?</label>
                </div>
                <div class="linha">
                    <input type="text" name="refSolida" id="refSolidaId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="refLiquidaId">O que foi servido para beber?</label>
                </div>
                <div class="linha">
                    <input type="text" name="refLiquida" id="refLiquidaId">
                </div>
            </div>
            <div class="area-btn">
                <button type="button" class="btn mandar" id="analisarId">Enviar</button>
                <input type="reset" class="btn limpar" value="limpar">
            </div>
            <dialog id="confirmarId">
                <div class="cabecalho">
                    <div class="linha-cab">
                        <h3>Lanche da tarde do dia <span id="campoData"></span></h3>
                    </div>
                </div>
                <div class="linha">
                    <p>Foi servido <span id="campoRefSol"></span> com <span id="campoRefLiq"></span>.</p>
                </div>
                <div class="btns-dialog">
                    <input type="submit" class="btn mandar" id="enviarId" value="Confirmar" name="btn_lanche">
                    <input type="hidden" name="tipo" value="lt">
                    <button type="button" class="cancelar" id="cancelarId">Cancelar</button>
                </div>
            </dialog>
            <dialog id="erroId">
                <div class="linha">
                    <h3>Você não informou a <span id="campoErro"></span>.</h3>
                </div>
                <div class="btns-dialog">
                    <button type="button" class="sair" id="cancelarId">Sair</button>
                </div>
            </dialog>
        </form>
    </main>
    <footer>
        <p>Site desenvolvido por <a href="https://instagram.com/29erik_" target="_blank" rel="noopener noreferrer">Ramon Erik (Informática 2022-2024)</a></p>
    </footer>
    <script src="../js/modal.js"></script>
</body>

</html>