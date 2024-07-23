const btnAnalisar = document.querySelector('#analisarId');
const btnCancelar = document.querySelector('#cancelarId');
const btnSair = document.querySelector('.sair');
const modalConf = document.querySelector('#confirmarId');
const modalErro = document.querySelector('#erroId');

btnAnalisar.addEventListener('click', () => {
    const campoErro = document.querySelector('#campoErro'); 
    const campoData = document.querySelector('#campoData'); 
    const campoRefSol = document.querySelector('#campoRefSol'); 
    const campoRefLiq = document.querySelector('#campoRefLiq'); 
    const valorData = document.querySelector('#dataId').value;
    const valorRefSolida = document.querySelector('#refSolidaId').value;
    const valorRefLiquida = document.querySelector('#refLiquidaId').value;
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
        campoData.innerText = valorData;
        campoRefSol.innerText = valorRefSolida;
        campoRefLiq.innerText = valorRefLiquida;
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