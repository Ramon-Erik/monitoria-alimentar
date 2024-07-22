<?php
class Avaliacao {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=monitoria_alimentar_salaberga","root","");
        // $pdo = new pdo("mysql:host=sql311.infinityfree.com; dbname=if0_34490143_monitoria_alimentar_salaberga", "if0_34490143", "ZelVBWHTerGTZY");
    }

    public function cadastrar_avaliacao($av, $serie, $refeicao, $id_cardapio) {
        session_start();
        if (!isset($_SESSION['ultima_resposta']) || time() >=  $_SESSION['ultima_resposta'][1] or $_SESSION['maquina'] === 's') {
            $consulta = "INSERT INTO votacao VALUES (null, curdate(), :av, :serie, :refeicao, :id_cardapio, curtime())";

            $consulta_feita = $this->pdo->prepare($consulta);
            $consulta_feita->bindValue(":av", $av);
            $consulta_feita->bindValue(":serie", $serie);
            $consulta_feita->bindValue(":refeicao", $refeicao);
            $consulta_feita->bindValue(":id_cardapio", $id_cardapio);
            $consulta_feita->execute();

            $_SESSION['ultima_resposta'] = [time(), strtotime('tomorrow')];
            $_SESSION['maquina']= 'i';
            echo '<script>alert("Sucesso!")</script>';
            header("location: ../view/index.php");
        } else {
            header("location: ../view/erro.php?err=vote");
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
