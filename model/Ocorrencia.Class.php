<?php

Class Ocorrencia{
    public function ocorrido($quem_ocor) {
    
        $tipo = $quem_ocor;
                    
                    switch ($tipo) {
                    case 'aluno':
                        header('location:../view/ocorrencia/ocorrencia-aluno.php');

                        exit;
                        break;
                    case 'funcionario':
                        header('location:../view/ocorrencia/ocorrencia-funcionario.php');
                        exit;
                        break;
                    }
            
                }
    

    public function ocorrencia($oq_ocor, $quando_ocor) {

        $pdo = new pdo("mysql:host=localhost; dbname=monitoria_alimentar", "root", "");
        $consulta = "INSERT INTO ocorrencia VALUES (null, curdate(), :ocorrido , null)";
        $consulta_feita = $pdo->prepare($consulta);
        $consulta_feita->bindValue(":ocorrido", $oq_ocor);
        //$consulta_feita->bindValue(":id_cardapio", $quando_ocor);
        $consulta_feita->execute();
            
    }
}
?>