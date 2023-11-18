fetch("../php/checarsessao.php")
	.then(response => response.json())
	.then(data => {
	if (!data.sessao) {
		window.location.href = '../html/login.html?autenticar';
		}
	})

const checagem = new URLSearchParams(window.location.search);
const id = checagem.get("id");

fetch(`../php/sorteioquery.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        const nome = data.nome;
		const date = data.date;
        const contato = data.contato;
		const formato = data.formato;
		const maioridade = data.maioridade;
		const maximo = data.maximo;
		const numero = data.numero;
		
		mostrarDados(id, nome, date, formato, maximo, contato, maioridade, numero);
    })
    .catch(error => {
		console.error('Erro ao buscar dados: ', error);
    });

function formatarData(date) {
  const partesData = date.split('-');
  const dataFormatada = `${partesData[2]}/${partesData[1]}/${partesData[0]}`;
  return dataFormatada;
};
	
function mostrarDados(i, n, d, f, x, c, m, u) {
	
	const pId = document.getElementById('pid');
	const pNome = document.getElementById('pnome');
	const pData = document.getElementById('pdata');
	const pFormato = document.getElementById('pformato');
	const pMaximo = document.getElementById('pmaximo');
	const pContato = document.getElementById('pcontato');
	const pMaioridade = document.getElementById('pmaioridade');
	const pNumero = document.getElementById('pnumero');
	const divMaximo = document.getElementById('divmaximo');
	const divContato = document.getElementById('divcontato');
	
	pId.innerHTML = i;
    pNome.innerHTML = n;
	pData.innerHTML = formatarData(d);
	pFormato.innerHTML = f;
	pMaximo.innerHTML = x;
	pContato.innerHTML = c;
	pNumero.innerHTML = u;
	if (m) {
		pMaioridade.innerHTML = "Sim";
	} else {
		pMaioridade.innerHTML = "Não";
	}
	
	if (x === null) {divMaximo.remove();}
	if (c === null) {divContato.remove();}
};