<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Curso PHP variaveis</title>
		<meta charset="utf-8">

	</head>
	<body>

		<?php 

			//string
			$nome = 'Allan Bastos';

			//int
			$idade = 22;

			// float
			$peso = 88.5;

			//boolean
			$fumante_sn = true;

			$idade = '23';
		 ?>

		 <h1>Ficha cadastral</h1>
		 <br>
		 <p>Nome: <?= $nome?></p>
		 <p>Idade: <?= $idade?></p>
		 <p>Peso: <?= $peso?></p>
		 <p>Fumante: <?= $fumante_sn?></p>
	</body>
</html>