<?php 
include('./class/Componente.php'); 
include('config.php');
 include('painel/class/Painel.php');


 if(isset($_GET['logout'])){
  Painel::logout();
 
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/style.css">
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>_bootstrap/css/bootstrap.css">
    
    <!--ICON GOOGLE-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">

    <link rel="shortcut icon" href="img/facebook.png" type="image/x-icon">
    <!--jQuery -->

    <script src="<?php echo INCLUDE_PATH?>js/jquery-3.6.3.js"></script>
    <script src="<?php echo INCLUDE_PATH?>js/constants.js"></script>

    <title><?php echo NOME_SITE; ?></title>
  </head>
  <body style="background-color:#f2f2f2;">
     <?php Componente::carregarNav(); ?>
     
    
     <div class="container-principal" style="background-color:#f2f2f2; height: 100%;">
   
   <?php
      $url = isset($_GET['url']) ? $_GET['url'] : 'noticia'; //Buscando a pagina home

      if(file_exists('page/'.$url.'.php')){
        include('page/'.$url.'.php');
      }else{
        //Podemos fazer o que quiser pois a pagina nao existe
			if( $url != 'contato'){

            $urlPar = explode('/',$url)[0];
            if($urlPar == 'noticia'){
              include('page/noticia.php');
            }else{
            include('page/404.php');
            }
      }else{
				include('page/login.php');
			}

      }

      
   ?>
 </div>

    <?php
     if (strstr($url[0],'noticia') !== false) {
   
      ?>
        <script>
          $(function(){
            $('select').on('change', function() {
                  location.href=include_path+"noticia/"+$(this).val();
              });
          })
        </script> 
      <?php } ?>
      
      
      <script src="js/custom.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/popper.min.js"></script>
   <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>