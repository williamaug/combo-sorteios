fetch("../php/checarsessao.php")
	.then(response => response.json())
	.then(data => {
	if (!data.sessao) {
		window.location.href = '../html/login.html?autenticar';
		}
	})

fetch('../php/usuarioquery.php')
    .then(response => response.json())
    .then(data => {
        const nome = data.nome;
        const email = data.email;
		const documento = data.documento;
		const maioridade = data.maioridade;
		
		mostrarDados(nome, email, documento, maioridade);
    })
    .catch(error => {
		console.error('Erro ao buscar dados: ', error);
    });

let pNome = document.getElementById('pnome');
let pEmail = document.getElementById('pemail');
let pDocumento = document.getElementById('pdocumento');
let pMaioridade = document.getElementById('pmaioridade');

function mostrarDados(n, e, d, m) {

    pNome.innerHTML = n;
	pEmail.innerHTML = e;
	pDocumento.innerHTML = d;
	if (m) {
		pMaioridade.innerHTML = "Sim";
	} else {
		pMaioridade.innerHTML = "Não";
	}
}

function editar() {
	
	let divNome = document.getElementById('divnome');
	let divEmail = document.getElementById('divemail');
	let divDocumento = document.getElementById('divdocumento');
	let divMaioridade = document.getElementById('divmaioridade');
	let divEditar = document.getElementById('diveditar');
	let divModificar = document.getElementById('divmodificar');
	
	let nomeAtual = pNome.textContent;
	let emailAtual = pEmail.textContent;
	let documentoAtual = pDocumento.textContent;
	let maioridadeAtual = "";
	if (pMaioridade.textContent === "Sim") {maioridadeAtual = "checked";}
	
	divNome.innerHTML = `<input id="nome" name="nome" type="text" autocomplete="name" value="${nomeAtual}">`;
	divEmail.innerHTML = `<input id="email" name="email" type="email" autocomplete="email" value="${emailAtual}">`;
	divDocumento.innerHTML = `
	<input id="documento" name="documento" type="text" autocomplete="off"
	pattern="^\\d{11}$|^\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}$|^\\d{14}$|^\\d{2}\\.\\d{3}\\.\\d{3}\/\\d{4}-\\d{2}$" value="${documentoAtual}">
	`;
	divMaioridade.innerHTML += `<input id="maioridade" name="maioridade" type="checkbox" ${maioridadeAtual}>`
	divModificar.innerHTML = `<input class="button" id="modificar" type="submit" value="Modificar"></input>`
	divEditar.innerHTML = `<button class="button" id="cancelar" onclick="location.reload()">Cancelar</button>`;
}
	