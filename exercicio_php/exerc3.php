
 <!-- Utilizando a condição switch(): 
a) Caso a $qtd de produtos for zero: mostrar uma mensagem informando que não possui nenhum produto cadastrado;
b) Caso a $qtd for 1: mostrar a mensagem: "Você possui um produto cadastrado";
c) Caso a $qtd for 1, 2 e 3: Mostrar a mensagem: "Você possui vários produtos cadastrados";
d) Caso não for nenhum desses números, mostrar: "Cadastro inválido, tente novamente"; -->

<?php
$quantidade = 2;
?>

<!Doctype html>
<html>
	<head>
		<title>exerc03</title>
		<meta charset="utf-8">
	</head>
		<body>

			<?php
			switch($quantidade) {

				case 0 :
					echo "*** -- Nenhum produto cadastrado -- ***";
					break;
						case 1 :
							echo "*** -- Possui um produto cadastrado -- ***";
							break;
								case ( $quantidade == 2 ||  $quantidade==3) :
									echo "*** -- Vários produtos cadastrados -- ***";
									break;
										
										default :
											echo "*** -- O Cadastro é inválido, tente novamente -- ***";
											break;
						}
			?>

		</body>
</html>