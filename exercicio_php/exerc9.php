<!--  9 - Criar um formulário HTML que tenha os campos abaixo e depois de submeter o formulário através de POST, utilizar o PHP para mostrar todos os dados submetidos:
a) hidden
b) text
c) password
d) textarea
e) checkbox
f) radio
g) select -->

<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">	
		<title>exer06</title>
	</head>
		
		<body>
			<h1>Contatos</h1>
				<form action="formulario.php" method="POST">
					<fieldset>
						<legend> Formulario </legend>
					</fieldset>
						
						<div class="formulario">
						<p>
						Nome: <input id="nome"	/>
						</p>
						</div>

							<div class="formulario">
							<p>
							Telefone: <input id="telefone" />
							</p>
							</div>

								<div class="formulario">
								<p>
								Exemplo com CheckBox:

								<?php if(isset($_POST["numeros"])) { echo "Os números de sua preferência são:<BR>"; 
								// Faz loop pelo array dos numeros 
								foreach($_POST["numeros"] as $numero) 
								{ echo "- " . $numero . "<BR>"; } } 
								else { echo "Você não escolheu número preferido!<br>"; 
								} 
								?>



								</p>
								</div>
						
							<div class="formulario">
							<p>
							Mensagem: <input id="mensagem" />
							</p>
							</div>

						<div class="formulario">
						<p>
						<form action = "select.php" method = "post">
						Testando a o Select
						<select name=selecao> 
						<option value=testes>Teste 1</option> 
						<option value=teste>Teste 2</option> 
						<option value=test>Teste 3</option> </select><BR><BR>



						</p>
						</div>
							
			</form>
		</div>
	</body>
</html>