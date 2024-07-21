<?php 

if (isset($_POST['tipo'])) {
    $tipo_refeicao = $_POST['tipo'];
    $data = $_POST['data'];
    $ref_solida = urlencode($_POST['refSolida']);
    $ref_liquida = urlencode($_POST['refLiquida']);
    // echo "Foi servido $ref_solida com $ref_liquida no dia $data";
    require_once('../model/Cardapio.Class.php');
    $cardapio = new Cardapio;
    $cardapio->registrar_lanche($data, $tipo_refeicao, $ref_solida, $ref_liquida);
}