<?php
class Relatorio
{
    public $intervalo, $horario, $pdo;
    public function __construct($intervalo, $horario)
    {
        $this->intervalo = $intervalo;
        $this->horario = $horario;
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga", "root", "");
        // $pdo = new pdo("mysql:host=sql311.infinityfree.com; dbname=if0_34490143_monitoria_alimentar_salaberga", "if0_34490143", "ZelVBWHTerGTZY");
    }

    public function clausula_intervalo()
    {
        switch ($this->intervalo) {
            default:
            case 'do_dia':
                return '0 DAY';
                break;
            case 'de_ontem':
                return '1 DAY';
                break;
            case 'ultimos_5_dias':
                return '5 DAY';
                break;
            case 'ultimos_15_dias':
                return '15 DAY';
                break;
            case 'ultimo_mes':
                return '1 MONTH';
                break;
            case 'ultimo_trimestre':
                return '3 MONTH';
                break;
            case 'ultimo_semestre':
                return '6 MONTH';
                break;
            case 'ultimo_ano':
                return '1 YEAR';
                break;
        }
    }

    public function clausula_horario()
    {
        switch ($this->horario) {
            default:
            case 'completo':
                return ['lm', 'al', 'lt'];
            case 'almoco':
                return ['al'];
            case 'lanches':
                return ['lm', 'lt'];
            case 'lanche_manha':
                return ['lm'];
            case 'lanche_tarde':
                return ['lt'];
        }
    }

    public function exibir_resultado_ocorrencia($resultado)
    {
        try {
            foreach ($resultado as $value) {
                $ref = ($value['tipo_refeicao'] == 'lm') ? 'lanche da manhã' : (($value['tipo_refeicao'] == 'lt') ? 'lanche da tarde' : 'almoço');
                echo "$value[data] $ref $value[ocorrido] <br>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function exibir_resultado_lanche($resultado)
    {
        try {
            foreach ($resultado as $value) {
                $ref_s = (is_null($value['ref_solida'])) ? 'nada' : $value['ref_solida'];
                $ref_l = (is_null($value['ref_liquida'])) ? 'nada' : $value['ref_liquida'];
                echo "$value[data] $ref_s $ref_l <br>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function exibir_resultado_almoco($resultado)
    {
        try {
            foreach ($resultado as $value) {
                $carboidrato = (is_null($value['carboidrato'])) ? 'nada' : $value['carboidrato'];
                $verdura = (is_null($value['verdura'])) ? 'nada' : $value['verdura'];
                $legume = (is_null($value['legume'])) ? 'nada' : $value['legume'];
                $fruta = (is_null($value['fruta'])) ? 'nada' : $value['fruta'];
                $suco = (is_null($value['suco'])) ? 'nada' : $value['suco'];
                $sobremesa = (is_null($value['sobremesa'])) ? 'nada' : $value['sobremesa'];
                $proteina = (is_null($value['proteina'])) ? 'nada' : $value['proteina'];
                echo "$value[data] $carboidrato $verdura $legume $fruta $suco $sobremesa $proteina<br>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
    
    public function exibir_resultado_completo($resultado)
    {
        try {
            foreach ($resultado as $value) {
                $ref_s_m = (is_null($value['lanche_manha_solida'])) ? 'nada' : $value['lanche_manha_solida'];
                $ref_l_m = (is_null($value['lanche_manha_liquida'])) ? 'nada' : $value['lanche_manha_liquida'];
                $ref_s_t = (is_null($value['lanche_manha_solida'])) ? 'nada' : $value['lanche_manha_solida'];
                $ref_l_t = (is_null($value['lanche_manha_liquida'])) ? 'nada' : $value['lanche_manha_liquida'];
                $carboidrato = (is_null($value['carboidrato'])) ? 'nada' : $value['carboidrato'];
                $verdura = (is_null($value['verdura'])) ? 'nada' : $value['verdura'];
                $legume = (is_null($value['legume'])) ? 'nada' : $value['legume'];
                $fruta = (is_null($value['fruta'])) ? 'nada' : $value['fruta'];
                $suco = (is_null($value['suco'])) ? 'nada' : $value['suco'];
                $sobremesa = (is_null($value['sobremesa'])) ? 'nada' : $value['sobremesa'];
                $proteina = (is_null($value['proteina'])) ? 'nada' : $value['proteina'];
                echo "$value[data] $ref_s_m $ref_l_m $carboidrato $verdura $legume $fruta $suco $sobremesa $proteina $ref_s_t $ref_l_t<br>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function exibir_resultado_votacao($resultado)
    {
    }

    public function ocorrencia()
    {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = 'SELECT ocorrencia.data, cardapio.tipo_refeicao, ocorrencia.ocorrido FROM ocorrencia INNER JOIN cardapio ON ocorrencia.id_cardapio = cardapio.id WHERE ocorrencia.data >= DATE_SUB(CURRENT_DATE, INTERVAL ' . $condicao_intervalo . ') AND cardapio.tipo_refeicao IN (' . $placeholders_str . ')';
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }
            $consulta_feita->execute();
            $this->exibir_resultado_ocorrencia($consulta_feita);
        } catch (PDOException $e) {
            echo '<pre>' . $e;
        }
    }

    public function cardapio_lanche()
    {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = "SELECT cardapio.data, cardapio_servido.ref_solida, cardapio_servido.ref_liquida FROM `cardapio` INNER JOIN cardapio_servido ON cardapio.id_cardapio_servido = cardapio_servido.id WHERE cardapio.tipo_refeicao IN (" . $placeholders_str . ") AND cardapio.data >= DATE_SUB(CURRENT_DATE, INTERVAL " . $condicao_intervalo . ") ORDER BY cardapio.data, cardapio.tipo_refeicao;";
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }
            $consulta_feita->execute();
            $this->exibir_resultado_lanche($consulta_feita);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function cardapio_almoco()
    {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = "SELECT cardapio.data, cardapio_servido.carboidrato, cardapio_servido.verdura, cardapio_servido.legume, cardapio_servido.fruta, cardapio_servido.suco, cardapio_servido.sobremesa, cardapio_servido.proteina FROM `cardapio` INNER JOIN cardapio_servido ON cardapio.id_cardapio_servido = cardapio_servido.id WHERE cardapio.tipo_refeicao IN (" . $placeholders_str . ") AND cardapio.data >= DATE_SUB(CURRENT_DATE, INTERVAL " . $condicao_intervalo . ") ORDER BY cardapio.data, cardapio.tipo_refeicao;";
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }
            $consulta_feita->execute();
            $this->exibir_resultado_almoco($consulta_feita);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function cardapio_completo()
    {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = "SELECT 
            cardapio.data,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'lm' THEN cardapio_servido.ref_solida END) AS lanche_manha_solida,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'lm' THEN cardapio_servido.ref_liquida END) AS lanche_manha_liquida,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.carboidrato END) AS carboidrato,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.verdura END) AS verdura,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.legume END) AS legume,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.fruta END) AS fruta,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.suco END) AS suco,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.sobremesa END) AS sobremesa,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'al' THEN cardapio_servido.proteina END) AS proteina,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'lt' THEN cardapio_servido.ref_solida END) AS lanche_tarde_solida,
            MAX(CASE WHEN cardapio.tipo_refeicao = 'lt' THEN cardapio_servido.ref_liquida END) AS lanche_tarde_liquida
            FROM 
                cardapio 
            INNER JOIN 
                cardapio_servido ON cardapio.id_cardapio_servido = cardapio_servido.id
            WHERE 
                cardapio.data >= DATE_SUB(CURRENT_DATE, INTERVAL " . $condicao_intervalo . ")
                AND cardapio.tipo_refeicao IN (" . $placeholders_str . ")
            GROUP BY 
                cardapio.data
            ORDER BY 
                cardapio.data;
            ";
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }
            $consulta_feita->execute();
            $this->exibir_resultado_completo($consulta_feita);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function votacao()
    {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = 'SELECT WHERE ocorrencia.data >= DATE_SUB(CURRENT_DATE, INTERVAL ' . $condicao_intervalo . ') AND cardapio.tipo_refeicao IN (' . $placeholders_str . ')';
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }
            $consulta_feita->execute();
            // $this->exibir_resultado_votacao($consulta_feita);
        } catch (PDOException $e) {
            echo '<pre>' . $e;
        }
    }
}
