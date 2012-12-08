
<!-- 2 - Depois da tag <h1> criar uma div #conteudo e nela adicionar o seguinte código PHP: 
 $nome1 = “Fulano”;
 $nome2 = “Fulana”;
 $nome3 = “Ciclano”;
 $sexo1 = “M”;
 $sexo2 = “F”;
 $sexo3 = “M”;
 a) Concatenar os nomes e imprimir numa tag <p>, e mostrar qual sexo predominante na equipe. Exemplo: 
Se o $sexo1 for igual a M, e $sexo2 for igual a M e $sexo3 for igual a M então mostrar uma mensagem dizendo que a equipe 1- Criar um arquivo PHP, e fazer o seguinte:
a) Criar a estrutura HTML
b) no Inicio do documento, criar a variável $title = “Site.com” e $subtitle = “este é um site em PHP”;
c) na tag <title> mostrar o seguinte texto concatenado: “Site.com – este é um site em PHP”;
d) dentro da DIV #rodape adicionar o seguinte texto: “® copyright Site.com – 2012”, sendo que o ® deve utilizar o código &reg; (HTML Entities) no html e o ano, deve ser mostrado o ano atual através do PHP com a função date. -->

<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>exerc02</title>
	</head>
<body>

	<h1> ** TESTE FORMACAO DA EQUIPE ** </h1>

	<?php
		$nome_1 = "Sheldon";
		$nome_2 = "Penny";
		$nome_3 = "Leonard";
		$sexo_1 = "Masculino";
		$sexo_2 = "Feminino";
		$sexo_3 = "Masculino";
	?>

	<p> <?php echo $nome_1." - ".$nome_2." - ".$nome_3; ?> </p>
		
			<?php
				if($sexo_1 == "Masculino" && $sexo_2 == "Feminino" && $sexo_3 == "Masculino"){
				
				?>
					<p>... A equipe é formada por guris ...</p>

					<?php }
						else if($sexo1 == "F" && $sexo2 == "F" && $sexo3 == "F"){
						?>
							<p>... A equipe é formada por gurias ...</p>	
					
						<?php  }
							else { ?>
						<p>A equipe é mista</p>
			<?php } ?>

	</body>
</html>