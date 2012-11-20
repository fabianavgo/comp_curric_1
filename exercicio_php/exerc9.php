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
			<form action="formulario.php" method="POST" onsubmit="return validar();">
				 <fieldset>

				<h1> Preencha o formulário </h1>		
					
						<!--hidden.php --> 
						<input type="hidden" name="pagina" value="informa"> 
					
				
						<p>
							<label for="idNome">*Digite seu nome:</label>							
							<input type="text" name="nome" id="idNome" required="true"><br> <br>
							<label for="idEmail">*Digite seu Email:</label>							
							<input type="text" name="email" id="idEmail" required="true"><br> 
						</p>
						
								<p>
									<label for="idSenha">*Digite uma senha:</label> 
									<input type="password" name="senha" id="idSenha"> <br>
								</p>

									<label for="idSexo">*Sexo:</label>
					                <br>
					                <input type="radio" name="sexo" id="idSexo"> Feminino
					                <input type="radio" name="sexo" id="idSexo1" >Masculino
					            
					                <br>

				
								<p>
								<label for="idInteresse" >Qual sua área de interesse?</label> <br> 
									
									<input type="checkbox" name="musica" id="idInteresse" >Musica<br> 
									<input type="checkbox" name="esporte" id="idInteresse" > Esporte<br>
									<input type="checkbox" name="noticia" id="idInteresse" > Noticias<br>
									<input type="checkbox" name="internet" id="idInteresse" > Internet<br> 
									<input type="checkbox" name="entreterimento" id="idInteresse" > Entreterimento<br>  
								</p>
																
							<p>
								<label for="idInformacao">Como ficou sabendo desse site:</label><br> 
								<input type="radio" name="televisao" id="idInformacao">  Televisão<br>
								<input type="radio" name="jornal" id="idInformacao"> Jornal<br>
								<input type="radio" name="internet" id="idInformacao"> Internet<br> 
								<input type="radio" name="amigos" id="idInformacao"> Amigos 
							</p>
							
						<p>
							<label for="idAvaliacao">*Como você avalia o site?</label> <br>
							<select required="isSelected"> 
							<option name="inicial"><label for="idAvaliacao" ></label></option> 
							<option name="pessimo"><label for="idAvaliacao">Péssimo</label></option> 
							<option name="regular"><label for="idAvaliacao">Regular</label></option> 
							<option name="bom"><label for="idAvaliacao">Bom</label></option>
							<option name="otimo"><label for="idAvaliacao">Ótimo</label></option>  
							</select>
						</p>

						 <p><label for="idComentario"> Deixe aqui seu comentário: </label>
						<br>
						<textarea name="comentario" id="idComentario"cols=30 rows=10 ></textarea> <br>
						<input name="submit" type="submit" value="ENVIAR" class="botao" >
					</p>
				</fieldset>	
			</form>
		</body>
</html>