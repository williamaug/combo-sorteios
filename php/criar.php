<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;500;600;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.svg">
    <title>Combo Sorteios</title>
    <link rel="stylesheet" href="../css/criarstyle.css">
</head>

<body>
    <h1>Criar Sorteio</h1>
    <div id="info">
        <div id="icone"></div>
        <section>
            <div class="atributo">
                <label class="mainlabel">Nome: </label>
                <input type="text" name="inputnome" id="inputnome">
            </div>
            <div class="atributo">
                <label class="mainlabel required">Data: </label>
                <input type="date" name="inputdata" id="data" required>
            </div>
            <div class="atributo">
                <label class="mainlabel required espaco">Formato: </label>
                <div id="divradio">
                    <div id="divdigital">
                        <input type="radio" id="digital" name="inputformato" value="digital" class="check" required>
                        <label for="digital" class="labelradio">Digital</label>
                    </div>
                    <input type="radio" id="presencial" name="inputformato" value="presencial" class="check" required>
                    <label for="presencial" class="labelradio">Presencial</label>
                </div>
            </div>
            <div class="atributo">
                <label class="mainlabel espaco">Apenas para maiores de idade? </label>
                <input type="checkbox" name="inputdocumento" class="check">
            </div>
        </section>
        <button class="button" id="editar">Criar Sorteio</button>
    </div>
    <a href="hub.php" class="button" id="voltar">Voltar à página anterior</a>
    <footer>
        <p><i>Combo</i> Sorteios</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>
