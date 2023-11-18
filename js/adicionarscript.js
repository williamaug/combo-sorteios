const checagem = new URLSearchParams(window.location.search);
let tipo = checagem.get("error");
if (tipo != null) {
	switch (tipo) {
		case '404':
			exibirMsg("Sorteio não encontrado.");
			break;
		case 'adm':
			exibirMsg("Você administra esse sorteio.");
			break;
		case 'added':
			exibirMsg("Você já adicionou esse sorteio.");
			break;
		case 'max':
			exibirMsg("Esse sorteio já atingiu seu máximo de participantes.");
			break;
		case 'function':
			exibirMsg("Houve um erro na adição do sorteio.");
			break;
	}
}

function exibirMsg(mensagem) {
    let erroElemento = document.getElementById('msg');
    erroElemento.innerHTML = `<p id="mensagem">${mensagem}</p>`;
};