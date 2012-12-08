<?php
	
	# codigo php
	//comentario em linha
	/*
	 * comentario em bloco
	 */
	
	echo "<h1>Olá mundo</h1>";

	//sempre inicia-se uma variável com $
	
	$nome1 = "Luis";
	$nome2 = "Paulo";
	$texto2 = "unoesc";
	echo $nome1. " e ". $nome2. " são grandes amigos";
	echo "$nome1 é um grande amigo de $nome2.";
	
	echo "{$nome1} estudou na {$texto2}";
	
	# Tipos de variáveis
	
	# Float
	$numero1 = 34.2;
	
	# Inteiros
	$numero2 = 123;
	
	# String
	$string = "texto";
	
	# Boolean
	$bool = True;
	
	# Array
	$lista = array("valor1", 12313, "valor3");
	
	# Versão 5.4
	# $lista = ["valor 1", 123123, "teste"];
	
	
	echo "<h2>Listas<h/h2>";
	echo $lista[0];
	
	$array[] = 123123;
	
	echo "<h2>Convertendo</h2>";
	
	$string = (int) "3 porquinhos";
	$string2 = (int) "porquinhos 3";
	
	echo $string . "<br>"; // 3
	echo $string2 . "<br>"; // 0 
	
	
	# Constantes
	
	define("PI", 3.14);
	printf ("O valor do PI é %f", PI);

	$frutas = array("maca", "banana", "pera", "uva");
?>

	<ul>
		<?php foreach ($frutas as $indice => $fruta) { ?>
		<li><?php echo $indice .": " . $fruta; ?></li>		
		<?php } ?>
	</ul>
		
		
	<hr />
	
	<ul>
		<?php for ($i=0; $i <count($frutas); $i++){ ?>
			<li><?php echo $frutas [$i]; ?> </li>
		<?php } ?>
	</ul>
	
	foreach ($frutas as $indice => $fruta) {
		echo "<p>{$indice}: {$fruta}</p>"
	}
	
	
	
	
?>	
