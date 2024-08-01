<?php 
if (isset($_POST['btn_rel'])) {
    session_start();
    $_SESSION['intervaloTempo'] = $_POST['intervalo'];
    $_SESSION['horario'] = $_POST['horario'];
    $tipoRelatorio = $_POST['relatorio'];
    switch ($tipoRelatorio) {
        case 'ocorrencia':
            header('location: ../view/cardapio/ocorrencia.php');
            break;
        case 'avaliacao':
            header('location: ../view/cardapio/avaliacao.php');
            break;
        case 'cardapio':
            header('location: ../view/cardapio/cardapio.php');
            break;
        default:
            header('location: ../view/erro.php?err=tp_r');
            break;
    }
}