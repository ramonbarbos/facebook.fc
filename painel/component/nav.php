

<nav class="navbar navbar-expand-lg navbar-light bg-light">
 
<div class="container">

          <ul class="navbar-nav"> <!--PARTE 1 -->

            
                  <a class="navbar-brand" href="<?php echo INCLUDE_PATH_PAINEL?>">Painel do Usuario</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                  <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo INCLUDE_PATH?>">Inicio</a>
                    </li>


                    </div>

                
              </ul> <!--FINAL 1 -->

              <ul class="navbar-nav"> <!--PARTE 2 -->
          
        
          <li class="nav-item dropdown">

             <!-- FOTO -->
               <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 

               <?php  if(Painel::logado() == false){  ?>
               <img style="height: 50px;width: 50px; border-radius: 100px;" src="<?php echo INCLUDE_PATH ?>img/user.png" alt="">
               <?php }else{  ?>
               <img style="height: 50px;width: 50px; border-radius: 100px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
               <?php }  ?>

               </a>
                 <!-- MENU -->
                <a class="dropdown-menu" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                         
                         Sair
                       </a>

             

               </li>
              
              


       </li>
     </ul><!--FINAL 2 -->

          
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