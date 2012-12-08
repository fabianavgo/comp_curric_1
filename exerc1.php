<!-- 2. Depois da tag <h1> criar uma div #conteudo e nela adicionar o seguinte código PHP: 
 $nome1 = “Fulano”;
 $nome2 = “Fulana”;
 $nome3 = “Ciclano”;
 $sexo1 = “M”;
 $sexo2 = “F”;
 $sexo3 = “M”;
 
a) Concatenar os nomes e imprimir numa tag <p>, e mostrar qual sexo predominante na equipe. Exemplo: 

Se o $sexo1 for igual a M, e $sexo2 for igual a M e $sexo3 for igual a M então mostrar uma mensagem dizendo que a equipe é formada por meninos;

Se o $sexo1 for igual a F, e $sexo2 for igual a F e $sexo3 for igual a F então mostrar uma mensagem dizendo que a equipe é formada por meninas;

Senão mostrar uma mensagem dizendo que a equipe é mista; -->

<meta charset="UTF-8"> 
	
	<?php $title= "Site.com";
	  $subtitle = "este é um site em PHP";
	?>
  
  
  <!DOCTYPE html>
  	<html>
  		<head>
  			<title>
  				<?php 
  				echo $title."-".$subtitle;
				//. é para concatenar 
				?>
  			</title>
  		</head>
  	
  		<body>
  			<?php 
  			echo $title."-".$subtitle;
			?>
			
			
			<div class="rodape"> 
				® copyright Site.com – 2012
				</div>
  		</body>
  
   	</html>