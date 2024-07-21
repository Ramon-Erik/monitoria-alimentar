<?php 
require_once('../model/User.Class.php');
if (isset($_POST['btn-login'])){
    $senha = $_POST['senha'];
    // echo $User;
    $av = new User;
    $av->login($senha);
}

if (isset($_GET['exit'])) {
    session_start();
    session_destroy();
    header('location: ../view/index.php');
}