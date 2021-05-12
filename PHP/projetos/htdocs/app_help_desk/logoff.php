<?php 
	
	session_start();
/*	echo '<pre>';
	print_r($_SESSION);
	echo '<pre>';

	//unset() destroi um indice especifico de um array
	unset($_SESSION['x']);

	echo '<pre>';
	print_r($_SESSION);
	echo '<pre>';

	// destrui a varíavel de sessão 
	// session_destroy()

	session_destroy();//será destruida


	echo '<pre>';
	print_r($_SESSION);
	echo '<pre>';*/

	session_destroy();
	header('Location: index.php');

 ?>