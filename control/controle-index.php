<?php 
    require_once('../model/Avaliacao.Class.php');
if (isset($_POST['btn'])){
    $avaliacao = $_POST['satisfacao'];
    // echo $avaliacao;
    $av = new Avaliacao;
    $av->cadastrar_avaliacao($avaliacao);
}
?>