<?php 

if (isset($_POST['tipo'])) {
    $tipo_refeicao = $_POST['tipo'];
    $data = $_POST['data'];
    $proteina = urlencode($_POST['proteina']);
    $carboidrato = urlencode($_POST['carboidrato']);
    $verdura = urlencode($_POST['verdura']);
    $legume = urlencode($_POST['legume']);
    $fruta = urlencode($_POST['fruta']);
    $suco = urlencode($_POST['suco']);
    $sobremesa = urlencode($_POST['sobremesa']);

    //echo "Foi servido $proteina, $carboidrato, $verdura, $legume, $fruta, $suco, $sobremesa no dia $data";
    require_once('../model/Cardapio.Class.php');
    $cardapio = new Cardapio;
    $cardapio->registrar_almoco($data, $tipo_refeicao, $proteina, $carboidrato, $verdura, $legume, $fruta, $suco, $sobremesa);
}