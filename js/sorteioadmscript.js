fetch("../php/checarsessao.php")
	.then(response => response.json())
	.then(data => {
	if (!data.sessao) {
		window.location.href = '../html/login.html?autenticar';
		}
	})

const erroElemento = document.getElementById('msg');
const checagem = new URLSearchParams(window.location.search);
let tipo = checagem.get("error");
if (tipo != null) {
	switch (tipo) {
		case 'id':
			exibirMsg("Sorteio não encontrado.");
			break;
		case 'name':
			exibirMsg("Nome excede o limite de caracteres.");
			break;			
		case 'contact':
			exibirMsg("Contato excede o limite de caracteres.");
			break;
		case 'date':
			exibirMsg("A data escolhida já passou.");
			break;
	}
}

const id = checagem.get("id");

fetch(`../php/sorteioadmquery.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        const nome = data.nome;
		const date = data.date;
        const contato = data.contato;
		const formato = data.formato;
		const maioridade = data.maioridade;
		const maximo = data.maximo;
		const inscritos = data.inscritos;
		
		mostrarDados(id, nome, date, formato, maximo, contato, maioridade, inscritos);
    })
    .catch(error => {
		console.error('Erro ao buscar dados: ', error);
    });

const sorte = document.getElementById('sorteados');
const rol = document.getElementById('roleta');
const pId = document.getElementById('pid');
const pNome = document.getElementById('pnome');
const pData = document.getElementById('pdata');
const pFormato = document.getElementById('pformato');
const pMaximo = document.getElementById('pmaximo');
const pContato = document.getElementById('pcontato');
const pMaioridade = document.getElementById('pmaioridade');
const pInscritos = document.getElementById('pinscritos');

function formatarData(date) {
  const partesData = date.split('-');
  const dataFormatada = `${partesData[2]}/${partesData[1]}/${partesData[0]}`;
  return dataFormatada;
};

function mostrarDados(i, n, d, f, x, c, m, s) {
	pId.innerHTML = i;
    pNome.innerHTML = n;
	pData.innerHTML = formatarData(d);
	pFormato.innerHTML = f;
	pInscritos.innerHTML = s;
	if (x != null) {
		pMaximo.innerHTML = x;
	} else {
		pMaximo.innerHTML = "N/A";
	}
	if (c != null) {
		pContato.innerHTML = c;
	} else {
		pContato.innerHTML = "N/A";
	}
	if (m) {
		pMaioridade.innerHTML = "Sim";
	} else {
		pMaioridade.innerHTML = "Não";
	}

	if(f === "Digital") {
		sorte.innerHTML = '<h4>- Formato Digital Detectado -<br>Clique o botão abaixo para sortear os números.</h4>';
		sorte.innerHTML += '<button class="button" id="rolar" onclick="habilitar()">Realizar Sorteio</button>';
		sorte.classList.add('margem');
	}
};

function desformatarData(formattedDate) {
  const partesData = formattedDate.split('/');
  const dataDesformatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`;
  return dataDesformatada;
};

function editar() {
	const hid = document.getElementById('hid');
	const divId = document.getElementById('divid');
	const divNome = document.getElementById('divnome');
	const divData = document.getElementById('divdata');
	const divFormato = document.getElementById('divformato');
	const divMaximo = document.getElementById('divmaximo');
	const divContato = document.getElementById('divcontato');
	const divMaioridade = document.getElementById('divmaioridade');
	const divInscritos = document.getElementById('divinscritos');
	const buttonEditar = document.getElementById('editar');
	const spanBotoes = document.getElementById('spanbotoes');
	
	let nomeAtual = pNome.textContent;
	let dataAtual = desformatarData(pData.textContent);
	let contatoAtual = pContato.textContent;
		if (contatoAtual === "N/A") {contatoAtual = "";}
	let maximoAtual = pMaximo.textContent;
		if (maximoAtual === "N/A") {maximoAtual = "";}
	let formatoAtualDigital = "";
	let formatoAtualPresencial = "";
		if (pFormato.textContent === "Digital") {formatoAtualDigital = "checked";}
		else {formatoAtualPresencial = "checked";}
	let maioridadeAtual = "";
		if (pMaioridade.textContent === "Sim") {maioridadeAtual = "checked";}
	
	erroElemento.remove();
	divId.remove();
	hid.innerHTML += `<input id="id" name="id" type="hidden" value=${id}>`
	pNome.remove();
	divNome.innerHTML = `<input id="nome" name="nome" type="text" class="texto" autocomplete="name" required value="${nomeAtual}">`;
	pData.remove();
	divData.innerHTML = `<input id="data" name="data" type="date" class="outro" autocomplete="off" required value=${dataAtual}>`;
	pContato.remove();
	divContato.innerHTML = `<input id="contato" name="contato" type="text" class="texto" autocomplete="off" value="${contatoAtual}">`;
	pFormato.remove();
	divFormato.innerHTML = `
		<div id="divradio">
			<div id="divdigital">
				<input type="radio" id="digital" name="formato" value="Digital" class="check" required ${formatoAtualDigital}>
				<label for="digital" class="labelradio">Digital</label>
			</div>
			<div id="divpresencial">
				<input type="radio" id="presencial" name="formato" value="Presencial" class="check" ${formatoAtualPresencial}>
				<label for="presencial" class="labelradio">Presencial</label>
			</div>
		</div>
	`;
	pMaioridade.remove();
	divMaioridade.innerHTML += `<input id="maioridade" name="maioridade" class="check" type="checkbox" ${maioridadeAtual}>`
	pMaximo.remove();
	divMaximo.innerHTML = `<input id="maximo" name="maximo" class="outro" type="number" min="2" max="4294967295" pattern="^\d{1,10}$" autocomplete="off" value=${maximoAtual}>`;
	divInscritos.remove();
	buttonEditar.remove();
	spanBotoes.innerHTML = `
		<div class="button" id="remover" onclick="confirmar()">Remover</div>
		<input class="button" id="modificar" type="submit" value="Modificar">
		<div class="button" id="cancelar" onclick="location.reload()">Cancelar</div>
	`;
}

function habilitar() {
	sorte.innerHTML = '';
	rol.innerHTML = `
		<label for="quantidade">Quantidade de Números:</label>
		<form id="formrolar">
			<input type="number" min="2" max="4294967295" name="quantidade" id="quantidade" required>
			<button type="submit" class="button" id="rolar">Sortear Números</button>
		</form>
	`;

	document.getElementById('formrolar').addEventListener('submit', function (event) {
		event.preventDefault();
		rolar();
	});

}

function confirmar() {
	let confirmacao = window.confirm("Você realmente deseja remover esse sorteio, assim como todas as inscrições nele registradas? Mantenha em mente que a remoção é um processo permanente, e após realizada não pode ser revertida.")
	if (confirmacao) {remover();}
}

function remover() {
	const jsonString = JSON.stringify(id);
	
	fetch("../php/removersorteio.php", {
	  method: 'POST',
	  headers: {'Content-Type': 'application/json'},
	  body: jsonString
	})
    .catch(error => {
		console.error('Erro ao enviar pedido de remoção: ', error);
		return;
    });
	
	window.location.href = "../html/hub.html";
}

let numArray = [];

function rolar() {
	
	let insc = document.querySelector('#pinscritos').textContent;
	insc = parseInt(insc);
	let quant = document.querySelector('#quantidade').value;
	quant = parseInt(quant);
	let numAl;

	if (insc < quant) {
		sorte.innerHTML = '<p>A quantidade de números não pode ser maior que o número de inscritos.</p>';
	} else {
		sorte.innerHTML = '<h4>Números Sorteados:</h4>';
		for (let i = 0; i < quant; i++) {
			do {
				numAl = Math.ceil(Math.random() * insc);
			} while (numArray.includes(numAl)||numAl===0);
			
			numArray.push(numAl);
		}
		sorte.innerHTML += `<p class="resultado">${numArray.join(' ')}</p>`;
		rol.innerHTML = `<button class="button" id="mostrar" onclick="mostrarGanhadores()">Mostrar Ganhadores</button>`;
	}
};

function mostrarGanhadores() {
	const enviar = {
		'numArray': numArray,
		'id': id
	};

	const jsonString = JSON.stringify(enviar);
	
	fetch("../php/checarganhadores.php", {
	  method: 'POST',
	  headers: {'Content-Type': 'application/json'},
	  body: jsonString
	})
    .then(response => response.json())
    .then(data => {
		exibirEmails(data);
    })
    .catch(error => {
		console.error('Erro ao buscar dados: ', error);
    });
}

function exibirEmails(emails) {
	for (let i = 0; i < emails.length; i++) {
		sorte.innerHTML += `<p class="resultado">${emails[i]}</p>`
	}
	rol.remove();
}

function exibirMsg(mensagem) {
    erroElemento.innerHTML = `<p id="mensagem">${mensagem}</p>`;
};