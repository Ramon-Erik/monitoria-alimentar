<?php 
require_once('../model/Avaliacao.Class.php');
require_once('../model/Cardapio.Class.php');
if (isset($_POST['btn'])){
    $av = new Avaliacao;
    $refeicao = $_POST['horario'];
    if ($av->validar_horario($refeicao)[0]) {
        $avaliacao = $_POST['satisfacao'];
        $serie = $_POST['serie'];
        if ($serie ===  'null-serie') {
            header('location: ../view/erro.php?err=serie');
        } else {
            $cardapio = new Cardapio;
            if (!$cardapio->get_cardapio(date('Y-m-d'), $refeicao)) {
                $id_cardapio = $cardapio->registrar_cardapio_nulo(date('Y-m-d'), $refeicao);
            } else {
                $id_cardapio = $cardapio->get_cardapio(date('Y-m-d'), $refeicao)['id'];
            }
            $av->cadastrar_avaliacao($avaliacao, $serie, $refeicao, $id_cardapio);
        }
    } else {
        header('location: ../view/erro.php?err='.$av->validar_horario($refeicao)[1]);
    }
}
?>