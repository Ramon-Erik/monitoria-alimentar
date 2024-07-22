
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
        <div class="linha">
                <h3><label for="serieId">Qual foi a refeição que aconteceu?</label></h3>
            </div>
            <select class="minimal" name="refeicao" >
                <option value="manha">Lanche da manhã</option>
                <option value="almoco">Almoço</option>
                <option value="tarde">Lanche da tarde</option>
            </select>
        <div class="opcao ocorrencia">
            <div class="linha">
                <h3><label>O que aconteceu?</label></h3>
            </div>
            <select class="minimal" name="oq_ocor">
                            <option name= "oq_ocor" value="atraso_fila">Atrasar para chegar na fila</option>
                            <option name= "oq_ocor"value="furar_fila">Furar fila</option>
                            <option name= "oq_ocor"value="ocupa-esp">Ocupar espaço desnecessariamente</option>
                            <option name= "oq_ocor"value="amb_sujo">Deixar o ambiente sujo</option>
            </select>

        </div>
        <div class="area-btn">
            <input type="submit" value="Enviar" name="btn2" class="btn mandar"/>
        </div>
        </section>
        </form>
    </main>
</body>
</html>