<?php 

	session_start();


	//autenticação 
	$usuario_autenticado = false;
	$usuario_id = null;
	$usuario_perfil_id = null;
	$perfis = array(1 => 'Administrativo' , 2 => 'Usuário');

	$usuarios_app = array(
		 array('id'=>1,'email' => 'admin@gmail.com', 'senha' => '1234', 'peril_id' => 1 ),
		 array('id'=>2,'email' => 'user@gmail.com', 'senha' => '1234', 'peril_id' => 1 ),
		 array('id'=>3,'email' => 'jose@gmail.com', 'senha' => '1234', 'peril_id' => 2 ),
		 array('id'=>4,'email' => 'maria@gmail.com', 'senha' => '1234', 'peril_id' => 2 ),
	);


	// print_r($_GET);

	// echo '<hr>';

	// echo $_GET["email"];
	// echo '<br>';
	// echo $_GET["senha"];

	// echo '<hr>';

	foreach ($usuarios_app as $user) {
	

		if($user['email'] == $_POST["email"] && $user['senha'] == $_POST["senha"]){
			$usuario_autenticado = true;
			$usuario_id = $user['id'];
			$usuario_perfil_id = $user['peril_id'];
		}
	}

	if($usuario_autenticado){
		$_SESSION['autenticado'] = 'SIM';
		$_SESSION['id'] = $usuario_id;
		$_SESSION['perfil_id'] = $usuario_perfil_id;
		header('Location: home.php');
	}
	else{
		$_SESSION['autenticado'] = 'NAO'; 
		header('Location: index.php?login=erro');
	}
	
	
 ?>