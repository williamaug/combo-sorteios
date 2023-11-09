let form = document.getElementById('form');
let sorte = document.getElementById('sorteados');
let rol = document.getElementById('roleta');

if(String(form.innerText) == "Digital") {
	sorte.innerHTML = '<h4>Formato Digital Detectado<br>Clique o botão abaixo para sortear os números.</h4>';
	sorte.innerHTML += '<button class="button" id="rolar" onclick="habilitar()">Realizar Sorteio</button>';
}

function habilitar() {
	sorte.innerHTML = '';
	rol.innerHTML += '<label for="inscritos">Número de Inscritos</label>';
    rol.innerHTML += '<input type="number" name="inscritos" id="inscritos">';
    rol.innerHTML += '<label for="quantidade">Quantidade de Números</label>';
    rol.innerHTML += '<input type="number" name="quantidade" id="quantidade">';
    rol.innerHTML += '<button class="button" id="rolar" onclick="rolar()">Sortear Números</button>';
}

function rolar() {
	
	let insc = document.querySelector('#inscritos').value;
	insc = parseInt(insc);
	let quant = document.querySelector('#quantidade').value;
	quant = parseInt(quant);
	let numArray = [];
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
		sorte.innerHTML += `<p id="resultado">${numArray.join(' ')}</p>`;
	}
};
