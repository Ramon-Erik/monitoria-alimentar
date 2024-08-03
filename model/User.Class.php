<?php
class User {
    public function login($senha) {
        session_start();
        if ($senha === '0') {
            $_SESSION['maquina'] = 's';
            // $_SESSION['ultima_resposta'] = [time(), strtotime('tomorrow')];
            // echo $_SESSION['maquina'];
            header("location: ../view/index.php");
        } else if ($senha === '1') {
            $_SESSION['login'] = 'admin';
            header('location: ../view/painel.php');
        } else {
            $_SESSION['maquina'] = ['n', 0];
            header("location: ../view/index.php");
        }
    }
}