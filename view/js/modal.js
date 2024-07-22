
    const btnAnalisar = document.querySelector('#analisarId');
    const btnAnalisar2 = document.querySelector('#analisarId2');
    const btnCancelar = document.querySelector('#cancelarId');
    const btnSair = document.querySelector('.sair');
    const modalConf = document.querySelector('#confirmarId');
    const modalErro = document.querySelector('#erroId');
    const campoErro = document.querySelector('#campoErro');

    function getInputValue(campo) {
        return document.querySelector(`.valor-input[data-campo="${campo}"]`).value;
    }

    function setCampoExibicao(campo, valor) {
        document.querySelector(`.campo-exibicao[data-campo="${campo}"]`).innerText = valor;
    }

    btnAnalisar.addEventListener('click', () => {
        const valorData = getInputValue('dataId');
        const valorRefSolida = getInputValue('refSolidaId');
        const valorRefLiquida = getInputValue('refLiquidaId');

        if (valorData === '') {
            campoErro.innerText = 'data';
            modalErro.showModal();
        } else if (valorRefSolida === '') {
            campoErro.innerText = 'comida';
            modalErro.showModal();
        } else if (valorRefLiquida === '') {
            campoErro.innerText = 'bebida';
            modalErro.showModal();
        } else {
            setCampoExibicao('dataId', valorData);
            setCampoExibicao('refSolidaId', valorRefSolida);
            setCampoExibicao('refLiquidaId', valorRefLiquida);
            modalConf.showModal();
        }
    });

    btnAnalisar2.addEventListener('click', () => {
        const valorData = getInputValue('dataId');
        const valorProteina = getInputValue('proteinaId');
        const valorCarboidrato = getInputValue('carboidratoId');
        const valorVerdura = getInputValue('verduraId');
        const valorLegume = getInputValue('legumeId');
        const valorFruta = getInputValue('frutaId');
        const valorSuco = getInputValue('sucoId');
        const valorSobremesa = getInputValue('sobremesaId');

        if (valorData === '') {
            campoErro.innerText = 'data';
            modalErro.showModal();
        } else if (valorProteina === '') {
            campoErro.innerText = 'proteína';
            modalErro.showModal();
        } else if (valorCarboidrato === '') {
            campoErro.innerText = 'carboidrato';
            modalErro.showModal();
        } else if (valorVerdura === '') {
            campoErro.innerText = 'verdura';
            modalErro.showModal();
        } else if (valorLegume === '') {
            campoErro.innerText = 'legume';
            modalErro.showModal();
        } else if (valorFruta === '') {
            campoErro.innerText = 'fruta';
            modalErro.showModal();
        } else if (valorSuco === '') {
            campoErro.innerText = 'suco';
            modalErro.showModal();
        } else if (valorSobremesa === '') {
            campoErro.innerText = 'sobremesa';
            modalErro.showModal();
        } else {
            setCampoExibicao('dataId', valorData);
            setCampoExibicao('proteinaId', valorProteina);
            setCampoExibicao('carboidratoId', valorCarboidrato);
            setCampoExibicao('verduraId', valorVerdura);
            setCampoExibicao('legumeId', valorLegume);
            setCampoExibicao('frutaId', valorFruta);
            setCampoExibicao('sucoId', valorSuco);
            setCampoExibicao('sobremesaId', valorSobremesa);
            modalConf.showModal();
        }
    });

    btnCancelar.addEventListener("click", function () {
        modalConf.close();
    });
    
    btnSair.addEventListener("click", function () {
        modalErro.close();
    });
    
    window.addEventListener('click', (event) => {
        if (event.target === modalConf || event.target === modalErro) {
            modalConf.close();
            modalErro.close();
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.querySelector('#enviarId');
        form.addEventListener('submit', function(event) {
            submitButton.disabled = true;
            submitButton.value = 'Enviando...';
        });
    });