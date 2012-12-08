<!--  9 - Criar um formulário HTML que tenha os campos abaixo e depois de submeter o formulário através de POST, 
utilizar o PHP para mostrar todos os dados submetidos:
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
			<form action="formulario.php" method="POST">
				 <fieldset>

				<h1> Preencha o formulário </h1>		
					
						<!--hidden.php --> 
						<input type="hidden" name="pagina" value="contato"> 
					
				
						<p>
							<label for="idNome">*Digite seu nome:</label>							
							<input type="text" name="nome" id="nome" required="true"><br> <br>
							<label for="idEmail">*Digite seu Email:</label>							
							<input type="text" name="email" id="email" required="true"><br> 
						</p>
						
								<p>
									<label for="senha">*Digite uma senha:</label> 
									<input type="password" name="senha" id="senha" required="true"> <br>
								</p>

									<label for="idSexo">*Sexo:</label>
					                <br>
					                <input type="radio" name="sexo" id="sexo"> Feminino
					                <input type="radio" name="sexo" id="sexo"> Masculino
					            
					                <br>

				
								<p>
								<label for="idInteresse" >Qual sua área de interesse?</label> <br> 
									
									<input type="checkbox" name="musica" id="musica" >Musica<br> 
									<input type="checkbox" name="esporte" id="esporte" > Esporte<br>
									<input type="checkbox" name="noticia" id="noticia" > Noticias<br>
									<input type="checkbox" name="internet" id="internet" > Internet<br> 
									<input type="checkbox" name="entreterimento" id="entreterimento" > Entreterimento<br>  
								</p>
																
							<p>
								<label for="idInformacao">Como ficou sabendo desse site:</label><br> 
								<input type="radio" name="televisao" id="televisao">  Televisão<br>
								<input type="radio" name="jornal" id="jornal"> Jornal<br>
								<input type="radio" name="internet" id="internet"> Internet<br> 
								<input type="radio" name="amigos" id="amigos"> Amigos 
							</p>
							
						<p>
							<label for="idAvaliacao">*Como você avalia o site?</label> <br>
							<select required="isSelected"> 
							<option name="inicial"><label for="inicial" ></label></option> 
							<option name="pessimo"><label for="pessimo">Péssimo</label></option> 
							<option name="regular"><label for="regular">Regular</label></option> 
							<option name="bom"><label for="bom">Bom</label></option>
							<option name="otimo"><label for="otimo">Ótimo</label></option>  
							</select>
						</p>

						 <p><label for="idComentario"> Deixe aqui seu comentário: </label>
						<br>
						<textarea name="comentario" id="idComentario"cols=30 rows=10 ></textarea> <br>
						<button class="btn btn-primary"> ENVIAR </button>
					</p>
				</fieldset>	
			</form>
		</body>
</html>