fetch("../php/checarsessao.php")
	.then(response => response.json())
	.then(data => {
	if (!data.sessao) {
		window.location.href = '../html/login.html?autenticar';
		}
	})

function exibirMsg(mensagem) {
	let erroElemento = document.getElementById('msg');
	erroElemento.innerHTML = `<p id="mensagem">${mensagem}</p>`;
};

const checagem = new URLSearchParams(window.location.search);
let tipo = checagem.get("error");
if (tipo != null) {
	switch (tipo) {
		case 'name':
			exibirMsg("Nome excede o limite de caracteres.");
			break;			
		case 'contact':
			exibirMsg("Contato excede o limite de caracteres.");
			break;
		case 'date':
			exibirMsg("A data escolhida já passou.");
			break;
		case 'function':
			exibirMsg("Houve um erro na criação do sorteio.");
			break;
	}
}