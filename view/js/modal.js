const btnAnalisar = document.querySelector('#analisarId');
const btnCancelar = document.querySelector('#cancelarId');
const btnSair = document.querySelector('.sair');
const modalConf = document.querySelector('#confirmarId');
const modalErro = document.querySelector('#erroId');

btnAnalisar.addEventListener('click', () => {
    const campo = document.querySelector('#campo'); 
    const dia = document.querySelector('#dia'); 
    const refSol = document.querySelector('#refSol'); 
    const refLiq = document.querySelector('#refLiq'); 
    const data = document.querySelector('#diaId');
    const refSolida = document.querySelector('#refSolidaId');
    const refLiquida = document.querySelector('#refLiquidaId');
    console.log(data.value, refLiquida.value, refSolida.value)
    if (data.value === '') {
        campo.innerText = 'data';
        modalErro.showModal();
    } else if (refSolida.value === '') {
        campo.innerText = 'comida';
        modalErro.showModal();
    } else if (refLiquida.value === '') {
        console.log(refSolida.value);
        campo.innerText = 'bebida';
        modalErro.showModal();
    } else {
        dia.innerText = data.value
        refSol.innerText = refSolida.value
        refLiq.innerText = refLiquida.value
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