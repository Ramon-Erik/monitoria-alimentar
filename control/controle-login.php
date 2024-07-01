<?php 
require_once('../model/User.Class.php');
if (isset($_POST['btn-login'])){
    $senha = $_POST['senha'];
    // echo $User;
    $av = new User;
    $av->login($senha);
}
?>