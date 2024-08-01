<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peça um relatório</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header></header>
    <main>
        <div class="cabecalho">
            <div class="linha-cab">
                <h1 class="titulo-center">Peça um relatório</h1>
            </div>
        </div>
        <form action="../../control/relatorio-index.php" method="post">
            <div class="linha">
                <label for="tipoRelatorioId">
                    <h2>Sobre o que será o relatório?</h2>
                </label>
            </div>
            <div class="linha opcao">
                <select class="minimal" id="tipoRelatorioId" name="relatorio">
                    <option value="ocorrencia">Ocorrência</option>
                    <option value="avaliacao">Avaliações</option>
                    <option value="cardapio">Cardápio</option>
                </select>
            </div>
            <div class="linha">
                <label for="intervaloId">
                    <h2>Qual o intervalo de tempo do relatório?</h2>
                </label>
            </div>
            <div class="linha">
                <select class="minimal" name="intervalo" id="intervaloId">
                    <option value="do_dia">Do dia</option>
                    <option value="de_ontem">De ontem</option>
                    <option value="ultimos_5_dias">Últimos cinco dias</option>
                    <option value="ultimos_15_dias">Últimos 15 dias</option>
                    <option value="ultimo_mes">Último mês</option>
                    <option value="ultimo_trimestre">Último trimestre</option>
                    <option value="ultimo_semestre">Último semestre</option>
                    <option value="ultimo_ano">Último ano</option>
                </select>
            </div>
            <div class="linha">
                <label for="horarioId">
                    <h2>O relatório deve envolver que tempo?</h2>
                </label>
            </div>
            <div class="linha">
                <select class="minimal" name="horario" id="horarioId">
                    <option value="completo">Completo</option>
                    <option value="almoco">Almoço</option>
                    <option value="lanches">Lanches</option>
                    <option value="lanche_manha">Lanche manhã</option>
                    <option value="lanche_tarde">Lanche tarde</option>
                </select>
            </div>
            <div class="area-btn">
                <input type="submit" value="Enviar" name="btn_rel" class="btn mandar">
                <input type="reset" value="Limpar" class="btn limpar">
            </div>
        </form>
    </main>
    <footer>
        <p>Site desenvolvido por <a href="https://instagram.com/29erik_" target="_blank" rel="noopener noreferrer">Ramon Erik (Informática 2022-2024)</a></p>
    </footer>
</body>

</html>