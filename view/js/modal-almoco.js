const btnAnalisar = document.querySelector('#analisarId');
const btnCancelar = document.querySelector('#cancelarId');
const btnSair = document.querySelector('.sair');
const modalConf = document.querySelector('#confirmarId');
const modalErro = document.querySelector('#erroId');

btnAnalisar.addEventListener('click', () => {
    const campoErro = document.querySelector('#campoErro'); 
    const campoArtigo = document.querySelector('#campoArtigo'); 
    const campoData = document.querySelector('#campoData');
    const valorData = document.querySelector('#dataId').value;
    const valoresInputs = document.querySelectorAll('.input-alimento');
    const camposInputs = document.querySelectorAll('.campo-alimento');
    let i;
    if (valorData === '') {
        campoErro.innerText = 'a data';
        modalErro.showModal();
    } else {
        for (i = 0; i < 7; i++) {
            const el = valoresInputs[i];
            if (el.value === '') {
                campoArtigo.innerText = i % 2 === 0 ? 'a' : 'o';
                campoErro.innerText = el.name === 'proteina' ? 'proteína' : el.name;
                modalErro.showModal();
                break;
            }
        }
    }
    if (i === 7) {
        for (i = 0; i < 7; i++) {
            console.log(i);
            camposInputs[i].innerText = valoresInputs[i].value; 
        }
        campoData.innerText = valorData;
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