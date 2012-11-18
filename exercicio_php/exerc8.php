<!-- 8 -Utilize o PHP para efetuar as seguintes conversões:
a) de string para integer
b) de integer para string
c) de string para array
d) de array para string
e) de integer para float
f) de float para string em formato de dinheiro: R$ 23,45  -->

<!Doctype html>

<?php

	//a)
	$string = '5698';
	$inteiro = (int)$string;
	echo var_dump($inteiro);
	echo "</br>";

		//b)
		$inteiro = (string)666;
		echo var_dump($inteiro);
		echo "</br>";

			//c)
			$string = "aqui, uma, lista";
			$array = explode(',', $string);
			print_r($array);
			echo "<br>";

				//d)
				$list = array("ola", "mundo");
				$string = implode(' ', $list);
				echo $string;
				echo "</br>";

					//e)
					$num = (float)219;
					echo var_dump($num);
					echo "</br>";

						//f)
						$valor = 38.79;
						echo "R$ " . number_format($valor, 2, ',', '.');
?>