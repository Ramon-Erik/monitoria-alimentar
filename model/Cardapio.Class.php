<?php 

Class Cardapio {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
    }

    public function get_cardapio($data, $horario) {
        try {
            $select = $this->pdo->prepare("SELECT * FROM cardapio WHERE data = :data and tipo_refeicao = :tipo");
            $select->bindValue(":data", $data); 
            $select->bindValue(":tipo", $horario); 
            $select->execute();
            $select = $select->fetch(PDO::FETCH_ASSOC);
            return $select;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }
    
    public function get_cardapio_servido($id) {
        try {
            $select = $this->pdo->prepare("SELECT * FROM cardapio_servido WHERE id = :id");
            $select->bindValue(":id", $id); 
            $select->execute();
            $select = $select->fetch(PDO::FETCH_ASSOC);
            return $select;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }
    
    public function registrar_cardapio_nulo($data, $horario) {
        try {
            $cardapio_servido = $this->pdo->prepare("INSERT INTO cardapio_servido (id) VALUES (null)");
            $cardapio_servido->execute();

            $ultimo_id = $this->pdo->lastInsertId();

            $cardapio = $this->pdo->prepare("INSERT INTO cardapio VALUES(null, :data, :horario, :ultimo_id)");
            $cardapio->bindValue(":data", $data); 
            $cardapio->bindValue(":horario", $horario); 
            $cardapio->bindValue(":ultimo_id", $ultimo_id); 
            $cardapio->execute();
            
            $ultimo_id = $this->pdo->lastInsertId();
            return $ultimo_id;
        } catch (Exception $e) {
            echo $e->getCode();
        }
    }

    public function count_null($array) {
        $quantidade = 0;
        foreach ($array as $value) {
            if ($value === NULL) {
                $quantidade++;
            }
        }
        return $quantidade;
    }

    public function atualizar_cardapio_lanche($id, $ref_solida, $ref_liquida) {
        try {
            $cardapio_servido = $this->pdo->prepare("UPDATE cardapio_servido set ref_solida = :ref_solida,ref_liquida = :ref_liquida where id = :id");
            $cardapio_servido->bindValue(":ref_solida", $ref_solida); 
            $cardapio_servido->bindValue(":ref_liquida", $ref_liquida); 
            $cardapio_servido->bindValue(":id", $id); 
            $cardapio_servido->execute();
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
            $id = $this->get_cardapio($data, $horario)['id'];
            $cardapio_atual = $this->get_cardapio_servido($id);
            switch ($this->count_null($cardapio_atual)) {
                case 7:
                    $this->atualizar_cardapio_lanche($id, $ref_solida, $ref_liquida);
                    break;
                default:
                    echo 'deu erro ' . $this->count_null($cardapio_atual);
                    break;
            }
        }
    }
}