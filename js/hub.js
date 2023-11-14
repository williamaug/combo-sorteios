// Supondo que você tenha os dados do banco de dados disponíveis em Listsortadm
let Listsortadm = ["Sorteio1", "Sorteio2", "Sorteio3"]; // Substitua isso pelos dados reais do seu banco de dados
let Listsortpar = ["Sorteio1", "Sorteio2", "Sorteio3"];
// Função para gerar a caixa
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
        <img clasxs="trevo" src="../imagens/shamrock.svg">
    `;

    colun.appendChild(novaCaixa1);
}

// Verifica se há dados em Listsortadm
if (Listsortadm.length === 0) {
    let colun = document.getElementById('lado1');
    colun.innerHTML += '<label>sorteio não encontrado</label>';
} else {
    // Gera as caixas com base nos dados
    for (let i = 0; i < Listsortadm.length; i++) {
        gerarCaixa1(Listsortadm[i]);
    }
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
        <img clasxs="trevo" src="../imagens/shamrock.svg">
    `;

    colun.appendChild(novaCaixa2);
}

// Verifica se há dados em Listsortadm
if (Listsortadm.length === 0) {
    let colun = document.getElementById('lado1');
    colun.innerHTML += '<label>sorteio não encontrado</label>';
} else {
    // Gera as caixas com base nos dados
    for (let i = 0; i < Listsortadm.length; i++) {
        gerarCaixa2(Listsortadm[i]);
    }
}
