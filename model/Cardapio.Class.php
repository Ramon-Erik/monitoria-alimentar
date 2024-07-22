<?php 

Class Cardapio {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
    }

    public function get_cardapio($data, $horario) {
        try {
            $select = $this->pdo->prepare("SELECT id FROM cardapio WHERE data = :data and tipo_refeicao = :tipo");
            $select->bindValue(":data", $data); 
            $select->bindValue(":tipo", $horario); 
            $select->execute();
            $select = $select->fetch(PDO::FETCH_ASSOC);
            return $select;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }
    
    public function registrar_lanche_nulo($data, $horario) {
        try {
            $select = $this->pdo->prepare("SELECT id FROM cardapio WHERE data = :data and tipo_refeicao = :tipo");
            $select->bindValue(":data", $data); 
            $select->bindValue(":tipo", $horario); 
            $select->execute();
            $select = $select->fetch(PDO::FETCH_ASSOC);
            return $select;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }

    public function registrar_lanche($data, $horario, $ref_solida, $ref_liquida) {
        if (!$this->get_cardapio($data, $horario)) {
            try {
                $cardapio_servido = $this->pdo->prepare("INSERT INTO cardapio_servido (ref_solida, ref_liquida) VALUES (:ref_solida, :ref_liquida)");
                $cardapio_servido->bindValue(":ref_solida", $ref_solida); 
                $cardapio_servido->bindValue(":ref_liquida", $ref_liquida); 
                $cardapio_servido->execute();

                $ultimo_id = $this->pdo->lastInsertId();

                $cardapio = $this->pdo->prepare("INSERT INTO cardapio VALUES(null, :data, :horario, :ultimo_id)");
                $cardapio->bindValue(":data", $data); 
                $cardapio->bindValue(":horario", $horario); 
                $cardapio->bindValue(":ultimo_id", $ultimo_id); 
                $cardapio->execute();
            } catch (Exception $e) {
                echo $e->getCode();
            }
        } else {
            echo 'x';
        }
    }
}