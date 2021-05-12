<?php 
	session_start();
	
	/*$titulo = str_replace('#', '-', $_POST['titulo']);
	$categoria = str_replace('#', '-', $_POST['categoria']);
	$descricao = str_replace('#', '-', $_POST['descricao']);

	$texo = $titulo . '#' . $categoria . '#' . $descricao;*/

	
	if(!empty($_POST['titulo']) || !empty($_POST['categoria']) || !empty($_POST['descricao'])){


		$_POST['titulo'] = str_replace('#', '-', $_POST['titulo']);
		$_POST['categoria'] = str_replace('#', '-', $_POST['categoria']);
		$_POST['descricao'] = str_replace('#', '-', $_POST['descricao']);

		$texto = $_SESSION['id'] .'#'. implode('#', $_POST) . PHP_EOL;

		$arquivo = fopen('../../app_help_desk/arquivo.hd', 'a');

		fwrite($arquivo, $texto);

		fclose($arquivo);


		header('Location: abrir_chamado.php?sucesso');
	}
	else{
		header('Location: abrir_chamado.php?erro_insercao');
	}
 ?>	