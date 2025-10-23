let indice = 0;
const totalImagens = 5;
const visiveis = 4; // Quantas aparecem ao mesmo tempo

function atualizarCarrossel() {
    const carrossel = document.querySelector('.carrossel');
    carrossel.style.transform = `translateX(-${indice * 25}%)`;
}

function avancar() {
    if (indice < totalImagens - visiveis) {
        indice++;
    } else {
        indice = 0;
    }
    atualizarCarrossel();
}

function voltar() {
    if (indice > 0) {
        indice--;
    } else {
        indice = totalImagens - visiveis;
    }
    atualizarCarrossel();
}

// Automático a cada 10s
setInterval(avancar, 10000);
