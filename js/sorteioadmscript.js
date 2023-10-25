let form = document.getElementById('form')
let rol = document.getElementById('roleta')
const numeroAleatorio = Math.floor(Math.random() * 100);
if(String(form.innerText) == "Digital"){
    rol.innerHTML = '<button id="rolar" onclick="rolar()"> ROLAR NUMERO </button>'
}
function rolar() {
    rol.innerHTML += `<p>${numeroAleatorio}</p>`
}
