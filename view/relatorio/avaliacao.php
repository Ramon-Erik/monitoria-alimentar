<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/tabela.css">
</head>
<body>
    <main>
        <section class="ct-tabela">
            <?php
            require_once '../../model/Relatorio.Class.php';
            session_start();
            $relatorio = new Relatorio($_SESSION['intervaloTempo'], $_SESSION['horario']);
            $relatorio->avaliacao();
            ?>
        </section>
    </main>
</body>
</html>