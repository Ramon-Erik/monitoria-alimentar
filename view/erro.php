<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algo deu errado!</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="https://icons.iconarchive.com/icons/aha-soft/desktop-buffet/48/Steak-icon.png" type="png">

</head>
<body>
    <main>
        <?php 
            if (isset($_GET['err'])) {
                $erro = $_GET['err'];
                switch ($erro) {
                    case 'vote':
                        echo "<h1 class=\"titulo-center\">Parece que você já votou hoje!</h1>";
                        echo "<p>Só é possivel votar uma vez por dia, mas se você acha que isso é um engano, entre em contato com os desenvolvedores.</p>";
                        break;
                    case 'serie':
                        echo "<h1>Antes de votar, selecione sua série!</h1>";
                        echo "<p>Só é possivel votar se informá-la.</p>";
                        break;
                    case 'ref':
                        echo "<h1>Selecione uma refeição para avaliar!</h1>";
                        echo "<p>Só é possivel votar após informar a refeição.</p>";
                        break;
                    case 'lm_h':
                        echo "<h1 class=\"titulo-center\">Ainda não deu o horário...</h1>";
                        echo "<p>Você tentou avaliar o lanche da manhã mas ainda não deu a hora. Verifique o horário e se selecionou a refeição correta e tente novamente!</p>";
                        break;
                    case 'al_h':
                        echo "<h1 class=\"titulo-center\">Ainda não deu o horário...</h1>";
                        echo "<p>Você tentou avaliar o almoço mas ainda não deu a hora. Verifique o horário e se selecionou a refeição correta e tente novamente!</p>";
                        break;
                    case 'lt_h':
                        echo "<h1 class=\"titulo-center\">Ainda não deu o horário...</h1>";
                        echo "<p>Você tentou avaliar o lanche da manhã mas ainda não deu a hora. Verifique o horário e se selecionou a refeição correta e tente novamente!</p>";
                        break;
                    case 'vt_lm':
                        echo "<h1 class=\"titulo-center\">Você já avaliou essa refeição...</h1>";
                        echo "<p>Você tentou avaliar o lanche da manhã mas já avaliou essa refeição. O que falta avaliiar: </p>";
                        break;
                    case 'vt_al':
                        echo "<h1 class=\"titulo-center\">Ainda não deu o horário...</h1>";
                        echo "<p>Você tentou avaliar o almoço mas já avaliou essa refeição. O que falta avaliiar: </p>";
                        break;
                    case 'vt_lt':
                        echo "<h1 class=\"titulo-center\">Ainda não deu o horário...</h1>";
                        echo "<p>Você tentou avaliar o lanche da tarde mas já avaliou essa refeição. O que falta avaliiar: </p>";
                        break;
                    default:
                        echo "<h1 class=\"titulo-center\">Página de erro.</h1>";
                        echo "<p>Parece que você parou aqui por engano.</p>";
                        break;
                }
            }
        ?>
    </main>
    <footer>
        <p>Site desenvolvido por <a href="https://instagram.com/29erik_" target="_blank" rel="noopener noreferrer">Ramon Erik (Informática 2022-2024)</a></p>
    </footer>
</body>
</html>