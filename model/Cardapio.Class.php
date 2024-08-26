<?php 

Class Cardapio {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
        // $pdo = new pdo("mysql:host=sql311.infinityfree.com; dbname=if0_34490143_monitoria_alimentar_salaberga", "if0_34490143", "ZelVBWHTerGTZY");
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

            $cardapio = $this->pdo->prepare("INSERT INTO cardapio(id, data, tipo_refeicao, id_cardapio_servido) VALUES(null, :data, :horario, :ultimo_id)");
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
    
    public function atualizar_cardapio_almoco($id, $elementos) {
        try {
            $cardapio_atual = $this->get_cardapio_servido($id);
            array_shift($cardapio_atual);
            $i = 0;
            foreach ($cardapio_atual as $key => $value) {
                if ($i == 7) {
                    break;
                }
                // echo "$i $key = $elementos[$i] <br><pre>";
                // print_r($cardapio_atual);
                // $consulta = 'UPDATE cardapio_servido set ' . $key . ' = ' . $elementos[$i] . ' where id = :id';
                $consulta = "UPDATE cardapio_servido set $key = '$elementos[$i]' where id = :id";
                // echo $consulta . '<br>';
                $cardapio_servido = $this->pdo->prepare($consulta);
                $cardapio_servido->bindValue(":id", $id); 
                $cardapio_servido->execute();
                $i++;
            }
        } catch (Exception $e) {
            echo $e->getCode() . ' ' . $e->getMessage();
        }
    }

    public function registrar_lanche($data, $horario, $ref_solida, $ref_liquida) {
        if (!$this->get_cardapio($data, $horario)) {
            try {
                $cardapio_servido = $this->pdo->prepare("INSERT INTO cardapio_servido(ref_solida, ref_liquida) VALUES (:ref_solida, :ref_liquida)");
                $cardapio_servido->bindValue(":ref_solida", $ref_solida); 
                $cardapio_servido->bindValue(":ref_liquida", $ref_liquida); 
                $cardapio_servido->execute();

                $ultimo_id = $this->pdo->lastInsertId();

                $cardapio = $this->pdo->prepare("INSERT INTO cardapio(id, data, tipo_refeicao, id_cardapio_servido) VALUES(null, :data, :horario, :ultimo_id)");
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

    public function registrar_almoco($data, $tipo_refeicao, $proteina, $carboidrato, $verdura, $legume, $fruta, $suco, $sobremesa) {
        if (!$this->get_cardapio($data, $tipo_refeicao)) {
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

                $cardapio = $this->pdo->prepare("INSERT INTO cardapio(id, data, tipo_refeicao, id_cardapio_servido) VALUES(null, :data, :tipo_refeicao, :ultimo_id)");
                $cardapio->bindValue(":data", $data); 
                $cardapio->bindValue(":tipo_refeicao", $tipo_refeicao); 
                $cardapio->bindValue(":ultimo_id", $ultimo_id); 
                $cardapio->execute();
            } catch (Exception $e) {
                echo $e->getCode();
            }
        } else {
            $id = $this->get_cardapio($data, $tipo_refeicao)['id'];
            $cardapio_atual = $this->get_cardapio_servido($id);
            switch ($this->count_null($cardapio_atual)) {
                case 9: //caso esteja tudo NULL
                case 2: //caso já tenha sido adicionado algo
                    $alimentos = [$proteina, $carboidrato, $verdura, $legume, $fruta, $suco, $sobremesa];
                    $this->atualizar_cardapio_almoco($id, $alimentos);
                    header('location: ../view/cardapio/almoco.php');
                    break;
                default:
                    echo 'deu erro ' . $this->count_null($cardapio_atual) . '<br>';
                    echo $this->count_null($cardapio_atual) . '<pre>';
                    print_r($cardapio_atual);
                    break;
            }
        }
    }
}