<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>exerc7</title>
	</head>
	<body>

		<!--> 7.	Descrever a sua funcionalidade e fazer exemplos das seguintes funções do PHP: </-->
		

		<h2> a) array() </h2>
		<p>Arrays são variaveis que servem para guardar, na memoria, valores diferentes de uma forma uniforme. Ex:</p>
		
		<?php
		$lista = array('Marina', 'José', 'Ana');

		for ($i = 0; $i < 3; $i++) {
			echo 'Posição: ' . $i . ' Nome: ' . $lista[$i] . '<br/>';
		}
		?>
		<h2>b) trim()</h2>
		<p>A função trim retira espaços que estiverem presentes no inicio e no final de uma string. Ex:</p>
		<?php
		$var1 = "     String com espaços     ";
			echo (trim($var1));
		?>
		
		<h2>c) substr()</h2>
		<p>Serve para retornar partes de uma String. Ex:</p>
		<?php
		echo substr('abcdef', 1);     // bcdef
		echo "</br>";
		echo substr('abcdef', 1, 3);  // bcd
		echo "</br>";
		echo substr('abcdef', 0, 4);  // abcd
		echo "</br>";
		echo substr('abcdef', 0, 8);  // abcdef
		echo "</br>";
		echo substr('abcdef', -1, 1); // f
		?>
		<h2>d) strtolower()</h2>
		<p> Serve para conveter toda a String em minuscula. Ex:</p>
		<?php
		echo strtolower("Hello MINUSCULA.");
		?>
		
		<h2>e) strtoupper()</h2>
		<p>Serve para conveter toda a String em minusculo. Ex:</p>
		<?php
		echo strtoupper("HELLO MAIUSCULA.");
		?>
		
		
		<h2>f) ucfirst()</h2>
		<p>Serve para converter a para maiúscula o primeiro caractere de uma string. Ex:</p>
		<?php
		echo ucfirst("tudo minusculo");
		?>
		
		<h2>g) ucwords()</h2>
		<p>Converte para maiúsculas o primeiro caractere de cada palavra. Ex:</p>
		<?php
		echo ucwords("tudo minusculo");
		?>
		
		<h2>h) explode()</h2>
		<p>Divide uma string em strings. Ex:</p>
		<?php
			$string = "micareta, carnaval, abada";
			$array = explode(',', $string);
			print_r($array);
			
		?>

		
		<h2>i) var_dump()</h2>
		<p>Mostra informações sobre a variável. Ex:</p>
		
		<?php
		$var1 = "     String com espaços     ";
			var_dump($var1);
		?>
		
		
		<h2>j) implode()</h2>
		<p>Junta elementos de uma matriz em uma string. Ex:</p>
		<?php
		$arr = array('Hello','World!','Beautiful','Day!');
		echo implode(" ",$arr);
		?>
		
		<h2>k) htmlspecialchars()</h2>
		<p> Converte caracteres especiais para a realidade HTML. Ex:</p>
		<?php
		$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
		echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;     
		?>
		
		
		<h2>l) join()</h2>
		<p>É um sinonimo de Implode() Ex:</p>
		<?php
		$arr = array('Hello','World!','Beautiful','Day!');
		echo join(" ",$arr);
		?>
		
		<h2>m) isset()</h2>
		<p>Verifica se uma constante já foi definida, retornando true ou false. Ex:</p>
		<?php
		$StringSet = 'bar';
		$StringNula;
 
		if (isset($StringSet))
		echo "TEM VALOR";
		 else {
		echo "NAO TEM VALOR";
		}
		echo "</br>";
		if (isset($StringNula))
		echo "TEM VALOR";
		 else {
		echo "NAO TEM VALOR";
		}
			
			?>
		
		<h2>n) strlen()</h2>
		<p>retorna o comprimento da string fornecida. Ex:</p>
		<?php
		$str = 'abcdsswdasf';
		echo strlen($str); // 11
        echo "</br>";
		$str = 'd aassab cd ';
		echo strlen($str); // 12
		?>
		
		<h2>o) is_float(), is_int(), is_array(), is_string(), is_bool(), is_numeric()</h2>
		<p>Informa se a váriavel é: float, int, array, string, boolean ou numerico. Ex:</p>
		<?php
		$var_name=127.55;  
		if (is_float($var_name)) 
		echo 'This is a float value.<br>';  
		
		$var_name=1;  
		if (is_int($var_name)) 
		echo 'This is a Integer value.<br>'; 
		
		$var_name= array(23.3, 56, 6);  
		if (is_array($var_name)) 
		echo 'This is a ARRAY value.<br>';
		
		$var_name= "CHATIADA";  
		if (is_string($var_name)) 
		echo 'This is a STRING value.<br>'; 
		
		$var_name= TRUE;  
		if (is_bool($var_name)) 
		echo 'This is a boolean value.<br>'; 
		
		$var_name=12755;  
		if (is_numeric($var_name)) 
		echo 'This is a numerico value.<br>'; 
		?>
		
		
		
		<h2>p) getdate()</h2>
		<p>Retorna informações data/hora. Ex:</p>
		<?php
			$today = getdate(); 
			print_r($today);
		?>
		
		<h2>q) empty()</h2>
		<p> Informa se a variável é vazia. Ex:</p>
		<?php 
		$var = 0;
		if (isset($var)) {
    		echo '$var está "setado" apesar de vazio';
		}
		?>
		
		<h2>r) strip_tags()</h2>
		<p> Retornar uma string retirando todas as tags HTML e PHP de string. Ex:</p>
		<?php
			$text = '<p>Oi Oi Oi.</p><!-- Comment --> <a href="#fragment">Other text</a>';
			echo strip_tags($text);
			echo "\n";

			echo strip_tags($text, '<p><a>');
		?>
		
		<h2>s) max(), min()</h2>
	<p>Se o primeiro e único parâmetro é um array, max() retorna o maior valor do array. Se no mínimo dois parâmetros são fornecidos, max() retornará o maior desses valores.</p>
	<?php
	echo max(1, 3, 5, 6, 7);
	// 7
	echo "<br>";
	echo max(array(2, 4, 5));
	// 5
	echo "<br>";

	echo max(0, 'hello');
	echo "<br>";
	// 0
	echo max('hello', 0);
	echo "<br>";
	
	echo max(-1, 'hello');
	echo "<br>";
	

	// Com arrays múltiplos, max compara da esquerda para direita,
	// assim nesse exemplo: 2 == 2, mas 4 < 5
	$val = max(array(2, 4, 8), array(2, 5, 7));
	// array(2, 5, 7)

	// Se forem informados um array e um não array, o array
	// é sempre retornado como se ele fosse o maior
	$val = max('string', array(2, 5, 7), 42);
	// array(2, 5, 7)
	?>

	<h2>t) abs()</h2>
	<p>Retorna o valor absoluto do numero.</p>

	<h2>u) ceil(), floor(), round()</h2>
	<p>Ceil: Retorna o próximo maior valor inteiro arredondando para cima do value, se fracionário. Ex:</p>
	<?php
	echo ceil(4.3);
	// 5
	echo "<br>";
	echo ceil(9.999);
	// 10
	echo "<br>";
	echo ceil(-3.14);
	// -3
		?>

	<p>Floor: Retorna o próximo menor valor inteiro ao se arredondar para baixo o valor indicado, se necessário. Ex:</p>
	<?php
	echo floor(4.3);
	// 4
	echo "<br>";
	echo floor(9.999);
	// 9
	echo "<br>";
	echo floor(-3.14);
	// -4
	?>

	<p>Round: Retornar um valor arredondado de um valor definindo o numero de casas decimais. Numero de casas pode ser negativo ou zero (padrão). Ex:</p>
	<?php
	echo round(3.4);
	// 3
	echo "<br>";
	echo round(3.5);
	// 4
	echo "<br>";
	echo round(3.6);
	// 4
	echo "<br>";
	echo round(3.6, 0);
	// 4
	echo "<br>";
	echo round(1.95583, 2);
	// 1.96
	echo "<br>";
	echo round(1241757, -3);
	// 1242000
	echo "<br>";
	echo round(5.045, 2);
	// 5.05
	echo "<br>";
	echo round(5.055, 2);
	// 5.06
	?>

	<h2>v) rand()</h2>
	<p>Se chamado sem os parâmetros opcionais min e max, rand() retornará um pseudo inteiro randômico entre 0 e getrandmax(). Se você precisa de um número aleatório entre 5 e 15 (inclusive), por exemplo, utilize rand (5, 15).</p>
	<?php
	echo rand() . "\n";
	echo "<br>";
	echo rand() . "\n";
	
	echo "<br>";
	echo rand(5, 15);
	?>

	<h2>w) sqrt()</h2>
	<p>Retorna a raiz quadrada de um valor.</p>
	<?php
	// Precisão depende de sua diretiva precision
	echo sqrt(9);
	// 3
	echo "<br>";
	echo sqrt(10);
	// 3.16227766 ...
	?>

	<h2>x) str_replace()</h2>
	<p>Esta função retorna uma string ou um array com todas as ocorrências de search em subject substituídas com o valor dado para replace.</p>
	<?php
	// Fornece: <body text='black'>
	$bodytag = str_replace("%body%", "black", "<body text='%body%'>");

	// Fornece: Hll Wrld f PHP
	$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
	$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");

	// Fornece: você comeria pizza, cerveja e sorvete todos os dias
	$frase = "você comeria frutas, vegetais, e fibra todos os dias.";
	$saudavel = array("frutas", "vegetais", "fibra");
	$saboroso = array("pizza", "cerveja", "sorvete");

	$novafrase = str_replace($saudavel, $saboroso, $frase);

	// Uso do parâmetro count está disponível no PHP 5.0.0
	$str = str_replace("ll", "", "good golly miss molly!", $count);
	echo $count;
	// 2

	// Order of replacement
	$str = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
	$order = array("\r\n", "\n", "\r");
	$replace = '<br />';
	// Processes \r\n's first so they aren't converted twice.
	$newstr = str_replace($order, $replace, $str);

	echo "<br>";
	// Saidas: apearpearle pear
	$letters = array('a', 'p');
	$fruit = array('apple', 'pear');
	$text = 'a p';
	$output = str_replace($letters, $fruit, $text);
	echo $output;
	?>

	<h2>y) count()</h2>
	<p>
	Conta os elementos de um array, ou propriedades em um objeto.
	</p>
	<?php
	$comidas = array('frutas' => array('laranja', 'banana', 'maçã'), 'veggie' => array('cenoura', 'couve', 'ervilha'));
	// contagem recursiva
	echo count($comidas, COUNT_RECURSIVE);
	// mostra 8
	// contagem normal
	echo count($comidas);
	// mostra 2
	?>

	<h2>z) htmlentities()</h2>
	<p>
	Converte todos os caracteres aplicáveis em entidades html. Ex:
	</p>
	<?php
	$str = "Uma 'citação' é <b>negrito</b>";
	echo htmlentities($str);
	echo "<br>";
	echo htmlentities($str, ENT_QUOTES);
	?>
	
	
	
	
	
	</body>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
