<?php 
if (isset($_POST['btn_rel'])) {
    session_start();
    $_SESSION['intervaloTempo'] = $_POST['intervalo'];
    $_SESSION['horario'] = $_POST['horario'];
    $tipoRelatorio = $_POST['relatorio'];
    switch ($tipoRelatorio) {
        case 'ocorrencia':
            header('location: ../view/relatorio/ocorrencia.php');
            break;
        case 'avaliacao':
            header('location: ../view/relatorio/avaliacao.php');
            break;
        case 'cardapio':
            if ($_POST['horario'] === 'completo') {
                header('location: ../view/relatorio/completo.php');
            }
            else if ($_POST['horario'] === 'almoco') {
                header('location: ../view/relatorio/almoco.php');
            }
            else if (str_contains($_POST['horario'], 'lanche')) {
                header('location: ../view/relatorio/lanche.php');
            } else {
                // erro com o horario solicitado
                header('location: ../view/erro.php?err=h_r');
            }
            break;
        default:
            // erro com o tipo de relatorio solicitado
            header('location: ../view/erro.php?err=tp_r');
            break;
    }
}