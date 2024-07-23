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
                <h1>Informar o cardápio do almoço</h1>
            </div>
        </div>
        <form action="../../control/cardapio-almoco.php" method="post" autocomplete="off">
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
                    <label for="proteinaId">Qual a proteína servida?</label>
                </div>
                <div class="linha">
                    <input type="text" name="proteina" class="input-alimento" id="proteinaId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="carboidratoId">Qual o carboidrato servido?</label>
                </div>
                <div class="linha">
                    <input type="text" name="carboidrato" class="input-alimento" id="carboidratoId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="verduraId">Qual a verdura servida?</label>
                </div>
                <div class="linha">
                    <input type="text" name="verdura" class="input-alimento" id="verduraId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="legumeId">Qual o legume servido?</label>
                </div>
                <div class="linha">
                    <input type="text" name="legume" class="input-alimento" id="legumeId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="frutaId">Qual a fruta servida?</label>
                </div>
                <div class="linha">
                    <input type="text" name="fruta" class="input-alimento" id="frutaId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="sucoId">Qual o suco servido?</label>
                </div>
                <div class="linha">
                    <input type="text" name="suco" class="input-alimento" id="sucoId">
                </div>
            </div>
            <div class="grupo">
                <div class="linha">
                    <label for="sobremesaId">Qual a sobremesa servida?</label>
                </div>
                <div class="linha">
                    <input type="text" name="sobremesa" class="input-alimento" id="sobremesaId">
                </div>
            </div>
            <div class="area-btn">
                <button type="button" class="btn mandar" id="analisarId">Enviar</button>
                <input type="reset" class="btn limpar" value="limpar">
            </div>
            <dialog id="confirmarId">
                <div class="cabecalho">
                    <div class="linha-cab">
                        <h3>Almoço do dia <span id="campoData"></span></h3>
                    </div>
                </div>
                <div class="linha">
                    <p>Foi servido <span class="campo-alimento" id="proteinaId"></span>, <span class="campo-alimento" id="carboidratoId"></span>, <span class="campo-alimento" id="verduraId"></span>, <span class="campo-alimento" id="legumeId"></span>, <span class="campo-alimento" id="frutaId"></span>, <span class="campo-alimento" id="sucoId"></span> e <span class="campo-alimento" id="sobremesaId"></span>.</p>
                </div>
                <div class="btns-dialog">
                    <input type="submit" class="btn mandar" id="enviarId" value="Confirmar" name="btn_almoco">
                    <input type="hidden" name="tipo" value="al">
                    <button type="button" class="cancelar" id="cancelarId">Cancelar</button>
                </div>
            </dialog>
            <dialog id="erroId">
                <div class="linha">
                    <h3>Você não informou <span id="campoArtigo"></span> <span id="campoErro"></span>.</h3>
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
    <script src="../js/modal-almoco.js"></script>
</body>

</html>