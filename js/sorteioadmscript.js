let form = document.getElementById('form')
let rol = document.getElementById('roleta')
let esp = document.getElementById('especif')

if(String(form.innerText) == "Digital"){
    esp.innerHTML += '<label>Limite dos numeros</label><br>'
    esp.innerHTML += '<input type="number" name="lim" id="lim"><br>'
    esp.innerHTML += '<label>Quantidade de numeros</label><br>'
    esp.innerHTML += '<input type="number" name="quan" id="quan"><br>'
    esp.innerHTML += '<br><button id="rolar" onclick="rolar()"> ROLAR NUMERO </button>'
}
var lim = document.querySelector('#lim')
var quan = document.querySelector('#quan')
function rolar() {
    rol.innerHTML = ''
    var c = 0
    var q = quan.value
    while(c < q){
        var l = lim.value
        const numeroAleatorio = Math.floor(Math.random() * l);
        rol.innerHTML += `<p>${numeroAleatorio}</p>`
        c = c + 1
    }
} 
