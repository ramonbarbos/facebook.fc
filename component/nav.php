<!DOCTYPE html>
<head>

  <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/nav.css">

</head>
<body>
<nav  >
 
    <div class='nav__left'>
      <a href="<?php echo INCLUDE_PATH; ?>">
        <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/100px-Facebook_f_logo_%282019%29.svg.png' />
      </a>
      <div class='nav__search'>
        <i class="material-icons">search</i>

        <form  method="post" >
        <input type='text' name="parametro"  placeholder="Perquisar no Facebook"/>
        </form>
        
      </div>
    </div> 
   



    <div class='nav__mid'>
        <a href='<?php echo INCLUDE_PATH; ?>' class='icon'>
          <i class='material-icons'>home</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>slideshow</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>groups</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>gamepad</i>
        </a>
    </div>



    <div class="nav__right">
        <a href='<?php echo INCLUDE_PATH; ?>usuario_single?user=<?php echo @$_SESSION['user']?>' class="avatar">
           
           
            <?php  if(Painel::logado() == false){  ?>
           <img class='avatar__img' src="<?php echo INCLUDE_PATH ?>img/user.png" alt="">
           <span><strong>User</strong></span>
           <?php }else{  ?>
           <img class='avatar__img' src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
           <span><strong><?php  echo substr($_SESSION['nome'],0,7); ?></strong></span>

           <?php }  ?>
        </a>
        <div class="buttons">
        <?php if(isset($_SESSION['user'])){ ?>
            <a data-bs-toggle="modal" href="#addFeed" role="button"><i class='material-icons'>add</i></a>
            <?php }else{ ?>
            <a data-bs-toggle="modal" ><i class='material-icons'>add</i></a>
            <?php } ?>
            <a href="#"><i class='material-icons'>messenger</i></a>
            <a href="#"><i class='material-icons'>notifications</i></a>

              

                 <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class='material-icons'>arrow_drop_down</i>
                  <!-- MENU -->
                      <div class="dropdown-menu">
                     
                        <?php  if(Painel::logado() == false){  ?>
                          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_LOGIN; ?>">
                          <i style="font-size: 15px; margin-right:10px" class='material-icons'>login</i>Entrar</a>
                        <?php }else{  ?>
                          <a style="display: none;" class="dropdown-item">Perfil</a>
                          <?php }  ?>

                          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i style="font-size: 15px; margin-right:10px" class='material-icons'>folder</i>Painel</a>
                     
                     
                          <a class="dropdown-item" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                          <i style="font-size: 15px; margin-right:10px" class='material-icons'>exit_to_app</i>
                            Sair
                          </a>

                          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal" >
                         
                        </a>
                      

                      </div>
              
                 </a>
              
              
         </div>
      </div>
    

</nav>

<!-- Modal -->


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Aviso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Tem certeza que deseja sair?  
      </div>
      <div class="modal-footer">
      <a class="btn btn-primary" href="<?php echo INCLUDE_PATH ?>?logout">Sim</a>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">não</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>

