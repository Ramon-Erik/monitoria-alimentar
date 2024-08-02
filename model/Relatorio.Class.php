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
                $cl_intervalo = '0 DAY';
                break;
            case 'de_ontem':
                $cl_intervalo = '1 DAY';
                break;
            case 'ultimos_5_dias':
                $cl_intervalo = '5 DAY';
                break;
            case 'ultimos_15_dias':
                $cl_intervalo = '15 DAY';
                break;
            case 'ultimo_mes':
                $cl_intervalo = '1 MONTH';
                break;
            case 'ultimo_trimestre':
                $cl_intervalo = '3 MONTH';
                break;
            case 'ultimo_semestre':
                $cl_intervalo = '6 MONTH';
                break;
            case 'ultimo_ano':
                $cl_intervalo = '1 YEAR';
                break;
        }
        return $cl_intervalo;
    }

    public function clausula_horario() {
        switch ($this->horario) {
            default:
            case 'completo':
                $cl_horario = '"lm" or cardapio.tipo_refeicao = "al" or cardapio.tipo_refeicao = "lt"';
                break;
            case 'almoco':
                $cl_horario = "'al'";
                break;
            case 'lanches':
                $cl_horario = "'lm'  or cardapio.tipo_refeicao = 'lt'";
                break;
            case 'lanche_manha':
                $cl_horario = "'lm'";
                break;
            case 'lanche_tarde':
                $cl_horario = "'lt'";
                break;
        }
        return $cl_horario;
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
            $condicao_horario = $this->clausula_horario();
            // echo "i = $condicao_intervalo e $condicao_horario";
            $con = 'SELECT ocorrencia.data, cardapio.tipo_refeicao, ocorrencia.ocorrido FROM ocorrencia INNER JOIN cardapio on ocorrencia.id_cardapio = cardapio.id where ocorrencia.data >= DATE_SUB(CURRENT_DATE(), INTERVAL :condicao_intervalo) and cardapio.tipo_refeicao = :condicao_horario;';
            $consulta_feita = $this->pdo->prepare($con);
            $consulta_feita->bindValue(":condicao_intervalo", $condicao_intervalo);
            $consulta_feita->bindValue(":condicao_horario", $condicao_horario);
            $consulta_feita->execute();
            foreach ($consulta_feita as $key => $value) {
                echo $value;
                $ref = ($value['tipo_refeicao'] == 'lm') ? 'lanche da manhã' : (($value['tipo_refeicao'] == 'lt') ? 'lanche da tarde' : 'almoço');
                echo "$value[data] $ref $value[ocorrido] <br>"; 
            }
            // $this->exibir_resultado($consulta_feita);
        } catch (PDOException $e) { echo '<pre>' . $e; }
    }

}