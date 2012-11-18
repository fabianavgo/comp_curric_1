<!-- Criar uma função chamada multiplica() e refazer o exercício 4d utilizando essa função.
Function multiplica (
     #codigo 4d
)
} -->
<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>exerc05</title>
	</head>
	<body>
		<p>
			Exercício 5
		</p>

			<?php

				function multiplica($var_1, $var_2) {

					$var = 0;
					for ($i = 0; $i < $var_1; $i++) {
						if($i == $var_1 - 1){
							echo $var_2 . " ";
							$var = $var + $var_2;
						}
						if($i < $var_1 - 1){
							echo $var_2 . "+";
							$var = $var + $var_2;
						}
					}
					echo "=" . $var;
				}

						multiplica(3, 5);
			?>

	</body>
</html>