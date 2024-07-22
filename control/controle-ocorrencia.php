<?php
require_once('../model/Ocorrencia.Class.php');

if (isset($_POST['btn'])){
    $quem_ocor= $_POST['option'];
    
    echo $quem_ocor;
    $x=new Ocorrencia;
    $x->ocorrido($quem_ocor);
}

if (isset($_POST['btn2'])){
    $oq_ocor= $_POST['oq_ocor'];
    $quando_ocor= $_POST['refeicao'];
    echo $oq_ocor;
    echo $quando_ocor;

    $x=new Ocorrencia;
    $x->ocorrencia($oq_ocor, $quando_ocor);
}
?>