const btnAnalisar = document.querySelector('#analisarId');
const btnAnalisar2 = document.querySelector('#analisarId2');
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

btnAnalisar2.addEventListener('click', () => {
    const campoErro = document.querySelector('#campoErro'); 
    const campoData = document.querySelector('#campoData'); 
    const campoProteina = document.querySelector('#campoProteina'); 
    const campoCarboidrato = document.querySelector('#campoCarboidrato'); 
    const campoVerdura = document.querySelector('#campoVerdura'); 
    const campoLegume = document.querySelector('#campoLegume'); 
    const campoFruta = document.querySelector('#campoFruta'); 
    const campoSuco = document.querySelector('#campoSuco'); 
    const campoSobremesa = document.querySelector('#campoSobremesa'); 
    const valorData = document.querySelector('#dataId').value;
    const valorProteina = document.querySelector('#proteinaId').value;
    const valorCarboidrato = document.querySelector('#carboidratoId').value;
    const valorVerdura = document.querySelector('#verduraId').value;
    const valorLegume = document.querySelector('#legumeId').value;
    const valorFruta = document.querySelector('#frutaId').value;
    const valorSuco = document.querySelector('#sucoId').value;
    const valorSobremesa = document.querySelector('#sobremesaId').value;
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
        campoData.innerText = valorData;
        campoProteina.innerText = valorProteina;
        campoCarboidrato.innerText = valorCarboidrato;
        campoVerdura.innerText = valorVerdura;
        campoLegume.innerText = valorLegume;
        campoFruta.innerText = valorFruta;
        campoSuco.innerText = valorSuco;
        campoSobremesa.innerText = valorSobremesa;
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