<?php 

Class Cardapio {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
    }

    public function cardapio_duplicado($data, $tipo_refeicao) {
        $select = $this->pdo->prepare("SELECT id FROM cardapio WHERE data = :data and tipo_refeicao = :tipo");
        $select->bindValue(":data", $data); 
        $select->bindValue(":tipo", $tipo_refeicao); 
        $select->execute();
        $select = $select->fetch(PDO::FETCH_ASSOC);
        return $select;
    }

    public function registrar_lanche($data, $tipo_refeicao, $ref_solida, $ref_liquida) {
        if (!$this->cardapio_duplicado($data, $tipo_refeicao)) {
            try {
                $cardapio_servido = $this->pdo->prepare("INSERT INTO cardapio_servido (ref_solida, ref_liquida) VALUES (:ref_solida, :ref_liquida)");
                $cardapio_servido->bindValue(":ref_solida", $ref_solida); 
                $cardapio_servido->bindValue(":ref_liquida", $ref_liquida); 
                $cardapio_servido->execute();

                $ultimo_id = $this->pdo->lastInsertId();

                $cardapio = $this->pdo->prepare("INSERT INTO cardapio VALUES(null, :data, :tipo_refeicao, :ultimo_id)");
                $cardapio->bindValue(":data", $data); 
                $cardapio->bindValue(":tipo_refeicao", $tipo_refeicao); 
                $cardapio->bindValue(":ultimo_id", $ultimo_id); 
                $cardapio->execute();
            } catch (Exception $e) {
                echo $e->getCode();
            }
        } else {
            echo 'erro';
        }
    }

    public function registrar_almoco($data, $tipo_refeicao, $proteina, $carboidrato, $verdura, $legume, $fruta, $suco, $sobremesa) {
        if (!$this->cardapio_duplicado($data, $tipo_refeicao)) {
            try {
                $cardapio_servido = $this->pdo->prepare("INSERT INTO cardapio_servido (proteina, carboidrato, verdura, legume, fruta, suco, sobremesa) VALUES (:proteina, :carboidrato, :verdura, :legume, :fruta, :suco, :sobremesa)");
                $cardapio_servido->bindValue(":proteina", $proteina); 
                $cardapio_servido->bindValue(":carboidrato", $carboidrato); 
                $cardapio_servido->bindValue(":verdura", $verdura); 
                $cardapio_servido->bindValue(":legume", $legume); 
                $cardapio_servido->bindValue(":fruta", $fruta); 
                $cardapio_servido->bindValue(":suco", $suco); 
                $cardapio_servido->bindValue(":sobremesa", $sobremesa); 
                $cardapio_servido->execute();

                $ultimo_id = $this->pdo->lastInsertId();

                $cardapio = $this->pdo->prepare("INSERT INTO cardapio VALUES(null, :data, :tipo_refeicao, :ultimo_id)");
                $cardapio->bindValue(":data", $data); 
                $cardapio->bindValue(":tipo_refeicao", $tipo_refeicao); 
                $cardapio->bindValue(":ultimo_id", $ultimo_id); 
                $cardapio->execute();
            } catch (Exception $e) {
                echo $e->getCode();
            }
        } else {
            echo 'erro';
        }
    }
}