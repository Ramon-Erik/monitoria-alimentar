<?php 
class Relatorio {
    public $intervalo, $horario, $pdo;
    public function __construct($intervalo, $horario) {
        $this->intervalo = $intervalo;
        $this->horario = $horario;
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
        // $pdo = new pdo("mysql:host=sql311.infinityfree.com; dbname=if0_34490143_monitoria_alimentar_salaberga", "if0_34490143", "ZelVBWHTerGTZY");
    }

    public function clausula_intervalo() {
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

    public function clausula_horario() {
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

    public function exibir_resultado($resultado) {
        try {
            foreach ($resultado as $key => $value) {
                $ref = ($value['tipo_refeicao'] == 'lm') ? 'lanche da manhã' : (($value['tipo_refeicao'] == 'lt') ? 'lanche da tarde' : 'almoço');
                echo "$value[data] $ref $value[ocorrido] <br>"; 
            }
        } catch (Exception $e) { echo $e; }
    }

    public function ocorrencia() {
        try {
            $condicao_intervalo = $this->clausula_intervalo();
            $condicoes_horario = $this->clausula_horario();
            $placeholders = [];
            foreach ($condicoes_horario as $index => $valor) {
                $placeholders[] = ":tipo_refeicao_$index";
            }
            $placeholders_str = implode(', ', $placeholders);

            $con = 'SELECT ocorrencia.data, cardapio.tipo_refeicao, ocorrencia.ocorrido FROM ocorrencia INNER JOIN cardapio ON ocorrencia.id_cardapio = cardapio.id WHERE ocorrencia.data >= DATE_SUB(CURRENT_DATE(), INTERVAL ' . $condicao_intervalo . ') AND cardapio.tipo_refeicao IN (' . $placeholders_str . ')';
            $consulta_feita = $this->pdo->prepare($con);
            foreach ($condicoes_horario as $index => $valor) {
                $consulta_feita->bindValue(":tipo_refeicao_$index", $valor, PDO::PARAM_STR);
            }            
            $consulta_feita->execute();
            $this->exibir_resultado($consulta_feita);
        } catch (PDOException $e) { echo '<pre>' . $e; }
    }

}