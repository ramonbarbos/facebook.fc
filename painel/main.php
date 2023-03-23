<?php

    include('class/ComponentePainel.php');
    include('class/Usuario.php');
    if(isset($_GET['logout'])){
        Painel::logout();
       
    }
//verificaPermissaoPagina(0);
    
?>



<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!--TINYMCE-->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>_bootstrap/css/bootstrap.css">

    <title>Painel</title>
  </head>
  <body >


     <?php ComponentePainel::carregarNav(); ?>


        <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link " <?php verificaPermissaoMenu(2) ?> href="<?php INCLUDE_PATH_PAINEL ?>cadastro">Usuario</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" <?php verificaPermissaoMenu(2) ?> href="<?php INCLUDE_PATH_PAINEL ?>noticia">Noticias</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>


      <?php  Painel::carregarPagina(); ?>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/popper.min.js"></script>
   <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/bootstrap.min.js"></script>

   

  </body>
</html>