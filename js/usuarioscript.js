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

const pNome = document.getElementById('pnome');
const pEmail = document.getElementById('pemail');
const pDocumento = document.getElementById('pdocumento');
const pMaioridade = document.getElementById('pmaioridade');

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
	
	const divNome = document.getElementById('divnome');
	const divEmail = document.getElementById('divemail');
	const divDocumento = document.getElementById('divdocumento');
	const divMaioridade = document.getElementById('divmaioridade');
	const divEditar = document.getElementById('diveditar');
	const divModificar = document.getElementById('divmodificar');
	const divCampos = document.getElementById('divcampos');
	
	let nomeAtual = pNome.textContent;
	let emailAtual = pEmail.textContent;
	let documentoAtual = pDocumento.textContent;
	let maioridadeAtual = "";
	if (pMaioridade.textContent === "Sim") {maioridadeAtual = "checked";}
	
	pNome.remove();
	divNome.innerHTML = `<input id="nome" name="nome" type="text" autocomplete="name" value="${nomeAtual}">`;
	pEmail.remove();
	divEmail.innerHTML = `<input id="email" name="email" type="email" autocomplete="email" value="${emailAtual}">`;
	pDocumento.remove();
	divDocumento.innerHTML = `
		<input id="documento" name="documento" type="text" autocomplete="off"
		pattern="^\\d{11}$|^\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}$|^\\d{14}$|^\\d{2}\\.\\d{3}\\.\\d{3}\/\\d{4}-\\d{2}$" value="${documentoAtual}">
	`;
	pMaioridade.remove();
	divMaioridade.innerHTML += `<input id="maioridade" name="maioridade" type="checkbox" ${maioridadeAtual}>`;
	divModificar.innerHTML = `
		<div id="divbotoes">
		<div class="button botaolinha" id="remover" onclick="confirmar()">Remover</div>
		<input class="button botaolinha" id="modificar" type="submit" value="Modificar"></input>
		<div class="button botaolinha" id="cancelar" onclick="location.reload()">Cancelar</div>
		</div>
	`;
	divCampos.classList.add("centralizar");
	divEditar.remove();
}

function confirmar() {
	let confirmacao = window.confirm("Você realmente deseja remover sua conta, assim como todas as inscrições nos sorteios nos quais ela é participante e sorteios por ela administrados? Mantenha em mente que a remoção é um processo permanente, e após realizada não pode ser revertida.")
	if (confirmacao) {remover();}
}

function remover() {
	fetch("../php/removerusuario.php", {
	  method: 'POST',
	  headers: {'Content-Type': 'application/json'}
	})
    .catch(error => {
		console.error('Erro ao enviar pedido de remoção: ', error);
		return;
    });
	
	window.location.href = "../index.html";
}