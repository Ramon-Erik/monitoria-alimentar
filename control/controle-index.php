<?php 
require_once('../model/Avaliacao.Class.php');
require_once('../model/Cardapio.Class.php');
if (isset($_POST['btn'])){
    $avaliacao = $_POST['satisfacao'];
    $serie = $_POST['serie'];
    $refeicao = $_POST['horario'];
    $cardapio = new Cardapio;
    if (!$cardapio->get_cardapio(date('Y-m-d'), $refeicao)) {
        $id_cardapio = $cardapio->registrar_cardapio_nulo(date('Y-m-d'), $refeicao);
    } else {
        $id_cardapio = $cardapio->get_cardapio(date('Y-m-d'), $refeicao)['id'];
    }
    $av = new Avaliacao;
    $av->cadastrar_avaliacao($avaliacao, $serie, $refeicao, $id_cardapio);
}
?>