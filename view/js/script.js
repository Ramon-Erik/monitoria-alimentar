const resetBtn = document.querySelector('input[type="reset"]')
const radioInputs = document.querySelectorAll('input[type="radio"]');
const labelBtns = document.querySelectorAll('label')
let valorSelecionado = null;

radioInputs.forEach(input => {
    input.addEventListener('change', () => {
        if (input.checked) {
            valorSelecionado = input.value;
        }
    });
});


labelBtns.forEach(label => {
    label.addEventListener('click', () => {
        labelBtns.forEach(otherLabel => {
            otherLabel.style.fontSize = '3rem';
        });
        label.style.fontSize = '4rem';
    });
});

resetBtn.addEventListener('click', () => {
    labelBtns.forEach(otherLabel => {
        otherLabel.style.fontSize = '3rem';
    });
})