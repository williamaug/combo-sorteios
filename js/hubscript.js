fetch("../php/checarsessao.php")
	.then(response => response.json())
	.then(data => {
	if (!data.sessao) {
		window.location.href = '../html/login.html?autenticar';
		}
	})

let listSortAdm = [];
let listSortPar = [];

fetch('../php/hubquery.php')
    .then(response => response.json())
    .then(data => {
        listSortAdm = data.listSortAdm || [];
        listSortPar = data.listSortPar || [];
		
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
    })
    .catch(error => {
		console.error('Erro ao buscar dados:', error);
    });

function gerarCaixa1(nomeSorteio) {
    let colun = document.getElementById('lado1');

    let novaCaixa1 = document.createElement('div');
    novaCaixa1.className = 'caixa';
    novaCaixa1.innerHTML = `
        <img class="trevo esquerdo" src="../imagens/shamrock.svg">
        <div class="alinhar">
            <p class="label">${nomeSorteio}</p>
            <a class="button" href="sorteioadm.html?${nomeSorteio}">Gerenciar Sorteio</a>
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
            <p class="label">${nomeSorteio}</p>
            <a class="button" href="sorteio.html?${nomeSorteio}">Ver Detalhes</a>
        </div>
        <img class="trevo" src="../imagens/shamrock.svg">
    `;

    colun.appendChild(novaCaixa2);
}
