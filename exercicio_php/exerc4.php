 <!-- Utilizando o for() e while():
a) Mostrar 25x a frase: "Lactobacilos vivos também possuem sentimentos";
b) Escrever um algoritmo que receba qualquer valor e mostre os valores de 0 até o número digitado. Ex: $var = 3; "0 1 2 3";
c) capturar dois valores em variáveis e mostrar os números entre eles. Ex: 5 e 10, imprimir: "6 7 8 9";
d) Escrever um algoritmo que multiplique os números utilizando apenas o operador +, ex: (3 * 5) = 5 + 5 + 5
	$n1 = 3
$n2 = 5
for($=0; $i
) -->

<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>exerc04</title>
	</head>
	<body>
		<p>
			*--- Exercicio_4_frase ---*
		</p>

				<p>
					***  ---a---  ***
				</p>
				<?php
				$frase = "Lactobacilos vivos também possuem sentimentos";

					for ($i = 0; $i < 25; $i++) {
						echo $frase . "<br>";
					}
				?>

					<p>
						***  ---b---  ***
					</p>
						
					<?php
					$var = 10;
					while (0 <= $var) :
					echo $var-- . "<br>";
					endwhile;
					?>

						<p>
							***  ---c---  ***
						</p>
						<?php
						$i = 10;
						$var = 20;
							while ($i <= $var) :
							echo $i++ . "<br>";
							endwhile;
						?>

							<p>
								***  ---d---  ***
							</p>
							<?php
							$v1 = 3;
							$v2 = 5;
							$var = 0;
								for ($i = 0; $i < $v1; $i++) {
								echo $v2 . " * ";
								$var = $var + $v2;
							}
							echo "=" . $var;
							?>

	</body>
</html>
