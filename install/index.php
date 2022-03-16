<?php

$r_errors = array();

if(phpversion() < 7) $r_errors[] = 'Required PHP Version is PHP VERSION >= 7. !';
if(!function_exists('curl_version')) $r_errors[] = 'Required cUrl Extension. !';
if(!ini_get('allow_url_fopen')) $r_errors[] = 'Enable URL fopen. !';
if(!function_exists('mysqli_connect')) $r_errors[] = 'Required nd_MySqli Extension. !';
if(!is_writable('../app/config_sample.php')) $r_errors[] = 'App/config_sample.php file is not writable. !';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $filename = 'db.sql';

  $mysql_host = trim($_POST['host']);
  $mysql_username = trim($_POST['user']);
  $mysql_password = trim($_POST['pass']);
  $mysql_database = trim($_POST['name']);



  if (true) {
    $conn = @mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);

  	if($conn){
  		mysqli_select_db($conn, $mysql_database);

      $templine = '';
      $lines = file($filename);

      foreach ($lines as $line){
      if (substr($line, 0, 2) == '--' || $line == '') continue;
        $templine .= $line;
        if (substr(trim($line), -1, 1) == ';') {
            mysqli_query($conn, $templine) or die('Error performing query \'<strong>' .  mysqli_error($conn) . '\': ' . 1 . '<br /><br />');
            $templine = '';
        }
      }
      generate_config($_POST);
    }else{
      $r_errors[] = 'Invalid database details !';
    }
  }else{
    $r_errors[] = 'Invalid Activation Key !';
  }



}


 ?>














<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../theme/default/assets/css/shared/style.css" >
    <link rel="stylesheet" href="./../theme/default/assets/css/dark/style.css" >

    <title>Gdrive Instalação</title>
  </head>
  <body class="antialiased">

    <div class="page">
      <div class="content">
        <div class="container-xl">

            <div class="row justify-content-center">
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <h2 id="classic-inputs" class="text-center mb-4"> <u>Parabéns você vai usar o Gdrive Pro </u> </h2>

                      <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($r_errors)): ?>
                        <?php if (!empty($r_errors)): ?>
                          <?php foreach ($r_errors as $error): ?>
                            <div class="alert alert-danger">
                              <?=$error?>
                            </div>
                          <?php endforeach; ?>
                        <?php else: ?>
                        <div class="alert alert-success">
                          Script pronto para instalação :)
                        </div>


                        <form class="" action="<?=$_SERVER['REQUEST_URI']?>" method="post">

                  

                          <hr>

                          <div class="mb-3">
                              <label class="form-label">DB HOST <sup class="text-danger">Requer</sup> </label>
                              <input type="text" class="form-control" name="host" placeholder="Digite localhost ou IP" required>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">DB USER <sup class="text-danger">Requer</sup></label>
                              <input type="text" class="form-control" name="user" placeholder="Nome de usuário" required>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">DB PASS</label>
                              <input type="text" class="form-control" name="pass" placeholder="Senha do usuário" >
                          </div>

                          <div class="mb-3">
                              <label class="form-label">DB NAME <sup class="text-danger">Requer</sup></label>
                              <input type="text" class="form-control" name="name" placeholder="Nome do banco de dados" required>
                          </div>

                          <input type="submit" class="btn btn-primary btn-block mt-3" name="submit" value="Instalar">


                        </form>

                        <?php endif; ?>
                      <?php else: ?>

                        <div class="alert alert-success">
                          <b>Parabéns !</b> Script instalado com sucesso.
                        </div>
                        <div class="alert alert-danger">
                          NÃO SE ESQUEÇA DE DELETAR <b> A PASTA </b> INSTALL
                        </div>

                        <a href="/login" class="text-center mt-3 mb-0"> <b>Fazer Login</b> </p>


                      <?php endif; ?>

                      <p class="text-center mt-3 mb-0" >Organizador de link Premium <a href="https://mercadophp.com/" target="_blank">MERCADOPHP</a> | 2021 </p>

                    </div>
                  </div>
              </div>
            </div>



        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  </body>
</html>




<?php

function generate_config($array){
	if(!empty($array)){
		if(file_exists('../app/config_sample.php')){
			$file = file_get_contents('../app/config_sample.php');
	    $file = str_replace("RHOST",trim($array["host"]),$file);
	    $file = str_replace("RDB",trim($array["name"]),$file);
	    $file = str_replace("RUSER",trim($array["user"]),$file);
	    $file = str_replace("RPASS",trim($array["pass"]),$file);
	    $fh = fopen('../app/config_sample.php', 'w') or die("Can't open config_sample.php. Make sure it is writable.");
	    fwrite($fh, $file);
	    fclose($fh);
	    rename("../app/config_sample.php", "../app/config.php");
		}else{
      die('config_example.php file does not exist !');
    }
	}
}



function getHost() {
    if (isset($_SERVER['HTTP_HOST'])) {
        $host = $_SERVER['HTTP_HOST'];
    } else {
        $host = $_SERVER['SERVER_NAME'];
    }
    return trim($host);
}






 ?>
