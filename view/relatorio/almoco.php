<?php 

require_once '../../model/Relatorio.Class.php';
session_start();
$relatorio = new Relatorio($_SESSION['intervaloTempo'], $_SESSION['horario']);
$relatorio->cardapio_almoco();