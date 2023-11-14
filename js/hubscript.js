let listSortAdm = ["Exemplo A", "Exemplo B"];
let listSortPar = ["Exemplo 1", "Exemplo 2"];
function gerarCaixa1(nomeSorteio) {
    let colun = document.getElementById('lado1');

    let novaCaixa1 = document.createElement('div');
    novaCaixa1.className = 'caixa';
    novaCaixa1.innerHTML = `
        <img class="trevo esquerdo" src="../imagens/shamrock.svg">
        <div class="alinhar">
            <label>${nomeSorteio}</label>
            <a class="button" href="sorteioadm.html">Gerenciar Sorteio</a>
        </div>
        <img class="trevo" src="../imagens/shamrock.svg">
    `;

    colun.appendChild(novaCaixa1);
}

function gerarCaixa2(nomeSorteio) {
    let colun = document.getElementById('lado2');

    let novaCaixa2 = document.createElement('div');
    novaCaixa2.className = 'caixa';
    novaCaixa2.innerHTML = `
        <img class="trevo esquerdo" src="../imagens/shamrock.svg">
        <div class="alinhar">
            <label>${nomeSorteio}</label>
            <a class="button" href="sorteioadm.html">Gerenciar Sorteio</a>
        </div>
        <img class="trevo" src="../imagens/shamrock.svg">
    `;

    colun.appendChild(novaCaixa2);
}

if (listSortAdm.length > 0) {
    for (let i = 0; i < listSortAdm.length; i++) {
        gerarCaixa1(listSortAdm[i]);
    }
}

if (listSortPar.length > 0) {
    for (let i = 0; i < listSortPar.length; i++) {
        gerarCaixa2(listSortPar[i]);
    }
}
