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
		<title>exer09</title>
	</head>
		
		<body>
			<h1>Exercicio 9</h1>
				<form action="formulario.php" method="POST">
											
						<div class="formulario">
						<p>
						
						</p>
						</div>


							<div class="formulario">
							<p>
							<form action="text.php" method="post"> 
							Text nome: <input type=text name=nome><br> 
							Text Email: <input type=text name=email><br><br> 
							</form>
							</p>
							</div>

								<div class="formulario">
								<p>
								<form action="text_area.php" method="post">
								Text Area: <textarea name=mensagem cols=10 rows=1 ></textarea><br>
								</form>
								</p>
								</div>

										<div class="formulario">
										<p>
										<form action="checkbox.php" method="post"> 
										Exemplo com CheckBox:<br> 
											<input type=checkbox name="numeros[]" value=10> 10<br> 
											<input type=checkbox name="numeros[]" value=100> 100<br> 
											<input type=checkbox name="numeros[]" value=1000> 1000<br>
											<input type=checkbox name="numeros[]" value=10000> 10000<br> 
											<input type=checkbox name="numeros[]" value=90> 90<br> 
											<input type=checkbox name="numeros[]" value=50> 50<br> 
											<input type=checkbox name="numeros[]" value=30> 30<br> 
											<input type=checkbox name="numeros[]" value=15> 15<br><BR> 
										</p>
										</div>
							
							<div class="formulario">
							<p>
								
								<form action="radio.php" method="post"> 
									<B>Exemplo como Radio:</B><br> 
									<input type=radio name=sistema value="t1"> TESTE 1 
									<input type=radio name=sistema value="t2"> TESTE 2
									<input type=radio name=sistema value="t3"> TESTE 3
									<input type=radio name=sistema value="t4"> TESTE 4 <br><br>
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