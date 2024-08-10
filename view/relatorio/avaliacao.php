<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/tabela.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
</head>
<body>
    <main>
        <section class="ct-tabela">
            <table id="myTable" class="cell-border">
                <?php
                require_once '../../model/Relatorio.Class.php';
                session_start();
                $relatorio = new Relatorio($_SESSION['intervaloTempo'], $_SESSION['horario']);
                $relatorio->avaliacao();
                ?>
            </table>
        </section>
    </main>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const tabelas = document.querySelectorAll('.ct-tabela');
                tabelas.forEach((el) => {
                    console.log(el);
                    let deslocamento;
                    if (document.body.clientWidth <= 380) {
                        deslocamento = 320;
                    } else {
                        deslocamento = 220
                    }
                    el.scroll({
                        top: 0,
                        left: deslocamento,
                        behavior: "smooth",
                    });
                });
            }, 1200);
        });
        var table = new DataTable('table.cell-border', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/pt-BR.json',
            },
            // lengthMenu: [5, 10, 25, 50, 75, 100]
        });
        table;
    </script>
</body>
</html>