<?php 
class Relatorio {
    public $intervalo, $horario;
    public function __construct($intervalo, $horario) {
        $this->intervalo = $intervalo;
        $this->horario = $horario;
    }

    public function ocorrencia() {}
    public function clausula_intervalo() {
        switch ($this->intervalo) {
            case 'do_dia':
                $cl_intervalo = '';
                break;
            case 'de_ontem':
                $cl_intervalo = '';
                break;
            case 'ultimos_5_dias':
                $cl_intervalo = '';
                break;
            case 'ultimos_15_dias':
                $cl_intervalo = '';
                break;
            case 'ultimo_mes':
                $cl_intervalo = '';
                break;
            case 'ultimo_trimestre':
                $cl_intervalo = '';
                break;
            case 'ultimo_semestre':
                $cl_intervalo = '';
                break;
            case 'ultimo_ano':
                $cl_intervalo = '';
                break;
            default:
                # code...
                break;
        }
    }
}