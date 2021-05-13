<? require_once "validador_acesso.php" ?>
<?php 
  
    //abrir arquivo.hd
  
  $chamados = array();

  $arquivo = fopen('../../app_help_desk/arquivo.hd', 'r');

  while (!feof($arquivo)) {
    $registro = fgets($arquivo); 

    $chamado_detalhes = explode('#', $registro);

    if (empty($registro)) {
      continue;
    }
    if($_SESSION['perfil_id'] == '2' ){
      if($_SESSION['id'] != $chamado_detalhes[0]){
        continue;
      }
    }

    $chamados[] = $registro;
    
  }

  fclose($arquivo);
 ?>

<html lang="pt-br">
  <head>
    <title>App Help Desk Consulta</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="logoff.php" class="nav-link">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">

              <? foreach ($chamados as $chamado) { 

                $chamado_dados = explode('#', $chamado);?>
              
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado_dados[1]; ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado_dados[2]; ?></h6>
                  <p class="card-text"><?= $chamado_dados[3]; ?></p>
                </div>
              </div>

              <? } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>