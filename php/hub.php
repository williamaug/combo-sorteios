<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset=UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;500;600;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.svg">
    <title>Combo Sorteios</title>
    <link rel="stylesheet" href="../css/hubstyle.css">
</head>

<body>
    <header>
        <a class="button" href="../index.html"> Encerrar Sessão e Sair
		<div id="voltar"></div>
		</a>
        <h1>Seus Sorteios</h1>
        <a class="button" href="usuario.html"> Informações do Usuário
		<div id="avatar"></div>
		</a>
		
    </header>
    <div class="colunas">
        <section class="topo-colunas">
            <h2>Administrador</h2>
        </section>
        <div id="topo-separador"></div>
        <section class="topo-colunas">
            <h2>Participante</h2>
        </section>
    </div>
    <div class="colunas">
        <section class="lado" id="lado1">
			<div class="caixa">
				<img class="trevo esquerdo" src="../imagens/shamrock.svg">
				<div class="alinhar">
					<label class="novo">Criar Novo Sorteio</label>
					<a class="button" href="criar.html">Criar Sorteio</a>
				</div>
				<img class="trevo" src="../imagens/shamrock.svg">
			</div>
	</section>
	<div id="separador"></div>
        <section class="lado" id="lado2">
		<div class="caixa">
			<img class="trevo esquerdo" src="../imagens/shamrock.svg">
			<div class="alinhar">
				<label class="novo">Adicionar Novo Sorteio</label>
				<a class="button" href="adicionar.html">Adicionar Sorteio</a>
			</div>
			<img class="trevo" src="../imagens/shamrock.svg">
		</div>
	</section>
    </div>
<script src="../js/hub.js"></script>
</body>

</html>
