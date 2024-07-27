<?php
class Avaliacao {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
        // $pdo = new pdo("mysql:host=sql311.infinityfree.com; dbname=if0_34490143_monitoria_alimentar_salaberga", "if0_34490143", "ZelVBWHTerGTZY");
    }

    public function validar_horario($ref) {
        $h_atual = new DateTimeImmutable();
        $h_atual = (int) $h_atual->modify('-3 hours')->format('G');
        if ($ref === 'null-horario') {
            // echo $ref . 'hhgtfgfgd';
            // header('location: ../view/erro.php?err=ref');
            return [false, 'ref'];
        } else if ($ref == 'lm' and $h_atual < 9) {
            return [false, 'lm_h'];
        } else if ($ref == 'al' and $h_atual < 12) {
            return [false, 'al_h'];
        } else if ($ref == 'lt' and $h_atual < 15) {
            return [false, 'lt_h'];
        }
        return [true];
    }

    public function pode_avaliar($refeicao) {
        session_start();
        $hoje = new DateTimeImmutable();
        $hoje = $hoje->modify('-3 hours')->format('d-m-Y');
        // echo 'vard '; 
        // var_dump($_SESSION['voto_lm']);
        switch ($refeicao) {
            case 'lm':
                if (isset($_SESSION['voto_lm']) ) {
                    $data_voto = DateTimeImmutable::createFromFormat('d-m-Y', $_SESSION['voto_lm']);
                    $data_liberada = $data_voto->modify('+1 day')->format('d-m-Y');
                    if ($hoje !== $data_liberada) {
                        return [false, 'vt_lm']; 
                    }
                } 
                break;
            case 'al':
                // $data_liberada = $_SESSION['voto_al']->modify('+1 day')->format('d-m-Y');
                if (isset($_SESSION['voto_al']) and $hoje !== $_SESSION['voto_al']->modify('+1 day')->format('d-m-Y')) {
                    return [false, 'vt_al']; 
                } 
                break;
            case 'lt':
                // $data_liberada = $_SESSION['voto_lt']->modify('+1 day')->format('d-m-Y');
                if (isset($_SESSION['voto_lt']) and $hoje !== $_SESSION['voto_lt']->modify('+1 day')->format('d-m-Y')) {
                    return [false, 'vt_lt']; 
                } 
                break;
        }
        return [true, true];
    }

    public function registrar_voto($av, $serie, $refeicao, $id_cardapio) {
        try {
            $consulta = "INSERT INTO votacao VALUES (null, curdate(), :av, :serie, :refeicao, :id_cardapio, curtime())";
            $consulta_feita = $this->pdo->prepare($consulta);
            $consulta_feita->bindValue(":av", $av);
            $consulta_feita->bindValue(":serie", $serie);
            $consulta_feita->bindValue(":refeicao", $refeicao);
            $consulta_feita->bindValue(":id_cardapio", $id_cardapio);
            $consulta_feita->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function cadastrar_avaliacao($av, $serie, $refeicao, $id_cardapio) {
        if ($this->pode_avaliar($refeicao)[0]) {
            $this->registrar_voto($av, $serie, $refeicao, $id_cardapio);
            $_SESSION["voto_$refeicao"] = new DateTimeImmutable();
            $_SESSION["voto_$refeicao"] = $_SESSION["voto_$refeicao"]->modify('-3 hours')->format('d-m-Y');
            $_SESSION['maquina']= 'i';
            header("location: ../view/index.php");
        } else {
            // var_dump($this->pode_avaliar($refeicao));
            // echo 'cad_av <pre>';
            // print_R($this->pode_avaliar($refeicao));
            header("location: ../view/erro.php?err=" . $this->pode_avaliar($refeicao)[1]);
        }
    }
    public function gerar_relatorio() {
        $consulta = "SELECT DISTINCT dia FROM avaliacao order by id DESC;";
        $consulta_feita = $this->pdo->prepare($consulta);
        $consulta_feita->execute();

        foreach ($consulta_feita as $arr) {
            $dia = $arr[0];
            echo '<div class="relatorio"><h3>&gt; Avaliações do almoço do dia ' . date("d/m/Y", strtotime($dia)) . '</h3>';

            $consulta = "SELECT  dia, COUNT(CASE WHEN nota = 'ruim' THEN 1 END) AS total_ruim, COUNT(CASE WHEN nota = 'bom' THEN 1 END) AS total_bom, COUNT(CASE WHEN nota = 'regular' THEN 1 END) AS total_regular FROM avaliacao WHERE dia = :dia GROUP BY dia;";
            $consulta_total_feita = $this->pdo->prepare($consulta);
            $consulta_total_feita->bindValue(':dia', $dia);
            $consulta_total_feita->execute();
            foreach ($consulta_total_feita as $valor) {
                $total =  $valor[1] + $valor[2] + $valor[3];
                
                $total_ruim = $valor[1];
                $total_bom = $valor[2];
                $total_regular = $valor[3];
                
                echo "<p>Total de avaliações do dia: $total; Bom: $total_bom; Regular: $total_regular; Ruim: $total_ruim </p>";
            }
            echo '<div class="charts" id="chart_div_' . $dia . '"></div></div>';
            echo " <script type=\"text/javascript\">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(desenharGrafico" . date('d_m_Y', strtotime($dia)) . ")

                function desenharGrafico" . date("d_m_Y", strtotime($dia)) . "() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    data.addRows([
                        ['Bom', " . $total_bom .  "],
                        ['Regular', " . $total_regular . "],
                        ['Ruim', " . $total_ruim . "],
                    ]);
                    var options = {title:' ', width:300, height:250};
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div_" . $dia . "'));
                    chart.draw(data, options);
            }</script>";
        }
    }
}
