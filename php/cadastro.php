<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;500;600;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../imagens/favicon.svg">
    <title>Combo Sorteios</title>
    <link rel="stylesheet" href="../css/cadastrostyle.css">
</head>
<body>
    <h1><i>Combo</i> Sorteios</h1>
    <section>
		<div>
		<h2>Cadastro</h2>
        <form>
            <p id="nome">
               Nome: <input type="text" name="inputnome" class="input">
            </p>
            <p id="idade">
                Você é maior de idade (18+)?
                <input type="checkbox" class="checkbox" name="checkidade">
            </p>
			<p class="required" id="documento">
				CPF/CNPJ: <input type="text" name="inputdocumento" class="input" required>
            <p class="required" id="email">
                E-mail:
                <input type="email" name="inputemail" class="input" required>
            </p>
            <p class="required" id="senha">
                Senha:
                <input type="password" name="inputsenha" class="input" required>
            </p>
        </form>
		</div>
        <a onclick="Cadastrar()" class="button" >Cadastrar-se</a>
        <p id="mensagem">Já possui uma conta?
            <a href="login.php" class="button">Entrar</a>
        </p>
    </section>
    <a href="../index.php" class="button" id="paginic">Voltar ao início</a>
    <script src=""></script>
</body>
</html>
