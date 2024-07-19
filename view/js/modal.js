const btnAnalisar = document.querySelector('#analisarId');
const btnCancelar = document.querySelector('#cancelarId');
const modalConf = document.querySelector('#confirmarId');
const modalErro = document.querySelector('#erroId');

btnAnalisar.addEventListener('click', () => {
    const campo = document.querySelector('#campo'); 
    const data = document.querySelector('#diaId');
    const refSolida = document.querySelector('#refSolidaId');
    const refLiquida = document.querySelector('#refLiquidaId');
    if (data.value === '') {
        campo.innerText = 'data';
        modalErro.showModal();
    } else if (refSolida.value === '') {
        campo.innerText = 'comida';
        modalErro.showModal();
    } else if (refLiquida.value === '') {
        campo.innerText = 'bebida';
        modalErro.showModal();
    } else {
        modalConf.showModal();
    } 
});

btnCancelar.addEventListener("click", function () {
    modalConf.close();
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