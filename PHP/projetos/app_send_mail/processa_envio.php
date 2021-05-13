<?php 
	
	require './bibliotecas/PHPMailer/Exception.php';
	require './bibliotecas/PHPMailer/PHPMailer.php';
	require './bibliotecas/PHPMailer/SMTP.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	$_POST;
	
	
	class Mensagem{
		private $para  = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => null);

		function __construct($para = 'allan.para.teste@gmail.com', $assunto = 'Teste', $mensagem = 'Teste'){

			$this->__set('para', $para);
			$this->__set('assunto', $assunto);
			$this->__set('mensagem', $mensagem);
		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $value)
		{
			$this->$atributo = $value;
		}

		public function mensagemValida()
		{
			if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
				return false;
			}

			return true;
		}
	}


	$mensagem = new Mensagem($_POST['para'], $_POST['assunto'], $_POST['mensagem']);

	if (!$mensagem->mensagemValida()) {
		header('Location: index.php');
		die();
	}

	$mail = new PHPMailer(true);

	try {
		//Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'allan.para.teste@gmail.com';                     //SMTP username
	    $mail->Password   = '!@#$1234';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('allan.para.teste@gmail.com', 'Teste Email Remetente');
	    $mail->addAddress($mensagem->para,$mensagem->para);     //Add a recipient

	    // $mail->addReplyTo('info@example.com', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //Attachments
	    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $mensagem->assunto;
	    $mail->Body    = $mensagem->mensagem; 
	    $mail->AltBody = $mensagem->mensagem;

	    $mail->send();

	    $mensagem->status['codigo_status'] = 1;
	    $mensagem->status['descricao_status'] = 'Mesagem foi enviada';

	    
	    
	} catch (Exception $e) {
		$mensagem->status['codigo_status'] = 2;
	    $mensagem->status['descricao_status'] = "Não foi possivel enviar esse e-mail! Por favor tente novamente mais tarde. Detalhes do erro: {$mail->ErrorInfo}";
	 
	}


?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	</head>

	<body>

		<div class="container">

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

			<div class="row">

				<div class="col-md-12">
					<?php if ($mensagem->status['codigo_status'] == 1) { ?>
						
						<div class="container">
							<h1 class="dispaly-4 text-success">Sucesso</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
						</div>

					<? } ?>

					<?php if ($mensagem->status['codigo_status'] == 2) { ?>
						
						<div class="container">
							<h1 class="dispaly-4 text-danger">Ops</h1>
							<p><?= $mensagem->status['descricao_status'] ?></p>
							<a href="index.php" class="btn btn-danger btn-lg mt-5 text-white">Voltar</a>
						</div>

					<? } ?>
				</div>
				
			</div>

		</div>

	</body>
</html>