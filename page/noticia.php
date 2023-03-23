
<?php 
  @$url = explode('/',$_GET['url']);
  if(!isset($url[2]))
  {
  $cat = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE slug = ?");
  $cat->execute(array(@$url[1]));
  $cat = $cat->fetch();
    //print_r($cat);
   //$cat['nome'];
?>






<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/feed.css">
  <script src="<?php echo INCLUDE_PATH?>js/jquery-3.6.3.js"></script>

</head>
<body>

<section class="section-primary" >

    <div class="container-post"><!--ADCIONAR NOTICIA-->

       <div class="post-1">
            <div class="content-img">
                      <?php if(Painel::logado() == false){ ?>
                        <div class="usuario-perfil" >
                          <img  src="<?php echo INCLUDE_PATH; ?>img/user.png" alt="Card image cap"  >
                        </div>
                        <?php }else{ ?>
                          <div class="usuario-perfil" >
                            <a  href="<?php echo INCLUDE_PATH; ?>usuario_single?user=<?php echo $_SESSION['user'];?>">
                              <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img'];?>" alt="Card image cap"  >
                            </a>
                          </div>
                          <?php } ?>
            
            </div>
            <?php if(isset($_SESSION['user'])){ ?>
                <a class="btn-add" data-bs-toggle="modal" href="#addFeed" role="button">
                 
                  <?php if(Painel::logado() == false){ ?>
                    <span>No que voce está pensando?</span>
                    <?php }else{ ?>
                    <span>No que voce está pensando, <?php echo   substr($_SESSION['nome'],0,7); ?>?</span>
                    <?php } ?>
                  
                  
                </a>
                <?php }else{ ?>
                  <a class="btn-add" >
                 
                 <?php if(Painel::logado() == false){ ?>
                   <span>No que voce está pensando?</span>
                   <?php }else{ ?>
                   <span>No que voce está pensando, <?php echo   substr($_SESSION['nome'],0,7); ?>?</span>
                   <?php } ?>
                 
                 
               </a>
                  <?php } ?>

       </div>
       <div class="line"></div>

          <div class="post-2">

          <?php if(isset($_SESSION['user'])){ ?>
              <a class="buttonAdd" data-bs-toggle="modal" href="#addFeed" role="button">

                <div class="icon-cam">
                 <i class='material-icons'>videocam</i>
                </div>
                <span>Video</span>

                  </a>

              <a class="buttonAdd" data-bs-toggle="modal" href="#addFeed" role="button">
                <div class="icon-photo">
                 <i class='material-icons'>photo_library</i>
                </div>
                <span>Foto</span>

                  </a>
                  <?php }else{ ?>
                       <a class="buttonAdd">

                            <div class="icon-cam">
                            <i class='material-icons'>videocam</i>
                            </div>
                            <span>Video</span>

                              </a>

                            <a class="buttonAdd">
                            <div class="icon-photo">
                            <i class='material-icons'>photo_library</i>
                            </div>
                            <span>Foto</span>

                      </a>
                    <?php } ?>
             
          </div>

    </div>

                <?php 
                     $porPagina = 100;
                      //CONSULTAR
                     $query = "SELECT * FROM `tb_site.noticias` ";
                     if(@$cat['nome'] !=''){
                       $query.="WHERE categoria_id = $cat[id]";
   
                     }
   
                     //PESQUISAR
   
                     if(isset($_POST['parametro'])){
                       $busca = $_POST['parametro'];
   
                       if(strstr($query, 'WHERE') !== false){
                           $query.=" AND conteudo LIKE '%$busca%' ";
                       }else{
                         $query.=" WHERE conteudo LIKE '%$busca%' ";
                       }
                     }
   
                     //PAGINAÇÃO
                     
                       if(!isset($_POST['parametro'])){  //CASO NAO TENHA PARAMETRO
   
                         if(isset($_GET['pagina'])){
                           $pagina = (int)$_GET['pagina'];
                           $queryPg = ($pagina - 1) * $porPagina;
                           $query.=" ORDER BY id DESC LIMIT $queryPg,$porPagina";
                         }else{
                           $pagina = 1;
                           $query.=" ORDER BY id DESC LIMIT 0,$porPagina";
                         }
                       }else{
                         $query.=" ORDER BY id DESC";
                         
                       }
                     
                     //BUSCAR NOTICIA 
   
                     $sql =  MySql::conectar()->prepare($query);
                     $sql->execute();
                     $noticias = $sql->fetchAll();
                    foreach($noticias as $key => $value) {
                      $sql =  MySql::conectar()->prepare("SELECT  `slug` FROM  `tb_site.categoria` WHERE id = ? ");
                      $sql->execute(array($value['categoria_id']));
                      $categoriaNome = $sql->fetch();


                      //Buscando usuario que publicou
                      
                      $user_id = $value['id_user'];
                     $usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));
              ?>




<div class="content-post"  ><!--INICIO NOTICIAS-->

<!--INICIO USUARIO-->
  <div class="usuario" >
          <div class="usuario-perfil">

            <a class="pelicula-perfil-user" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 
               <img class="perfil-user" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
           </a>

            <div class="info-usuario">
              <h6  ><?php echo @$usuario_resposavel['nome'];?> <?php echo @$usuario_resposavel['sobrenome'];?></h6>
              <p class=""><?php echo date('d/m/Y',strtotime($value['data']));?></p>
            </div>
        </div>
      

           <!--INICIO menu-->
           <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="icon-post">  

                        <i class='material-icons'>more_horiz</i>
                      </div>

                      <!-- MENU -->
                          
                          <?php if( @$usuario_resposavel['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) { ?>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                
                                <a class="dropdown-item"  onclick="apagarFeed(<?php echo $value['id']?>),window.location.reload()" >Apagar</a>

                          </div>
                              <?php }else{ ?>
                              
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                   <a class="dropdown-item" >Apagar</a>


                              </div>

                            <?php   }  ?>

             </a><!--final menu-->

     

      </div><!--FINAL USUARIO-->

    <!--INICIO NOTICIAS-->
      <div class="card-post" >

      
      <div class="info-card">
        <p class="card-text"><?php echo substr($value['conteudo'],0,100).'...';?></p>
        
      </div>

      <?php if(@$value['capa'] == '') {?>

        <div style="visibility: hidden;"> </div> 

        <?php }else{ ?>
          <div class="img-card">
          <img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$value['capa'] ?>" alt="Card image cap"  >
         </div>  

         <?php } ?>
        
        </div>

     

            
      <!--INICIO AÇÃO-->
        <div class="acao-post" >
            <div class="content-acao">

                  <a class="btn-curtir"   >
                            <i class='material-icons' >thumb_up</i>
                             <span>Curtir</span> 
                  </a>

                    <?php if(isset($_SESSION['user'])){ ?>
                    <a class="btn-comentar" onclick="listFeed(<?php echo $value['id']?>)" data-bs-toggle="modal"      href="#feedUser" role="button">
                            <i  class='material-icons'>chat</i>
                              <span>Comentar</span> 
                  </a>
                  <?php }else{ ?>
                    <a class="btn-comentar" >
                            <i  class='material-icons'>chat</i>
                              <span>Comentar</span> 
                  </a>
                    <?php } ?>


                  <a class="btn-repost" >
                            <i  class='material-icons'>share</i>
                              <span>Compartilhar</span> 
                  </a>
                          
   
            
            </div>
           

         

        </div><!--FINAL AAÇÃO-->


      </div> <!--FIM NOTICIAS-->
   

        <?php } ?>

</section> <!--FIM TOTAL-->


 
<!-- Modal ADD COMENTARIO -->


<div class="modal fade" id="feedUser" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Publicação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="window.location.reload()" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div id="idFeed" ></div>

        <!--INICIO USUARIO-->
          <div class="usuario" >
                  <div class="usuario-perfil">

                    <a class="pelicula-perfil-user" href=""> 
                     
                     <span class="perfil-user" id="imgUser" ></span>

                  </a>

                    <div class="info-usuario">
                      <h6  ><span id="nomeUser"  ></span></h6>
                      <p class=""><span id="dataFeed" ></span></p>
                    </div>
                </div>
      


       

      </div><!--FINAL USUARIO-->

           <!--INICIO NOTICIAS-->
         <div class="card-post" >
          
                <div class="info-card">
                  <span id="conteudoFeed" ></span>
                </div>

          

                <div id="capaFeed" >
                  
                </div>     
         
        </div>

     

            
      <!--INICIO AÇÃO-->
        <div class="acao-post" style="">
            <div class="content-acao" style=" ">

                  <a class="btn-curtir"   >
                            <i class='material-icons' >thumb_up</i>
                             <span>Curtir</span> 
                  </a>

                    <a class="btn-comentar" >
                            <i  class='material-icons'>chat</i>
                              <span>Comentar</span> 
                  </a>
                  <a class="btn-repost" style=" ">
                            <i  class='material-icons'>share</i>
                              <span>Compartilhar</span> 
                  </a>
                                  
            </div>

        </div><!--FINAL AAÇÃO-->

        <div class="comentarios-container">
              
            
                  <div class="container-coment">

                        <div id="idContent" class="content-coment"></div>

                        <span id="msg" > </span>
                        <div class="form-comentario" >
                             <a class="" href=""> 
                                    <img class="perfil-user-coment" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$_SESSION['img'];?>" alt="Card image cap"  >
                                </a>


                              <form id="cad-comentario-form" >
                                    <input type="text" name="comentario" placeholder="Escreva um comentario...">
                                    <input type="hidden"  name="id_user" value="<?php echo @$_SESSION['id'] ?>"  />
                                    <input type="hidden"  name="nome_user" value="<?php echo @$_SESSION['nome'] ?>"  />
                                    <input type="hidden"  name="img_user" value="<?php echo @$_SESSION['img'];?>"  />
                                    <input type="hidden"  name="data" value="<?php echo date('Y-m-d') ?>"  />
                                    <input type="submit" id="input" style="visibility: hidden;" value="enviar"  />

                              </form>
                        </div>
                 
              </div>
        </div>


      </div> <!--FIM NOTICIAS-->
   
     
       
   
      </div>
     
  </div>
</div>

<!-- Modal ADD PUBLICACAO -->


<div class="modal fade" id="addFeed" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Criar publicação</h1>
        <button type="button" class="btn-close" onClick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
                    <span id="msgADD" ></span>

      <div class="usuario" > <!--INICIO DO FORM-->

            <div class="usuario-perfil"> <!--INICIO DO HEADER-->

                <a class="pelicula-perfil-user" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$_SESSION['id'];?>"> 
                  <img class="perfil-user" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$_SESSION['img'];?>" alt="Card image cap"  >
                </a>

                <div class="info-usuario">
                  <h6  ><?php echo @$_SESSION['nome'];?></h6>
                </div>
                </div>   
            
        
            </div> <!--FIM DO HEADER-->

            <form id="car-publi-form" enctype="multipart/form-data" >
                <div class="content-conteudo">
                    <input type="text" name="conteudo" placeholder="No que voce está pensando, <?php echo   substr($_SESSION['nome'],0,7);?>?">
                    <input type="hidden"  name="id_user" value="<?php echo @$_SESSION['id'] ?>"  />
                    <input type="hidden"  name="data" value="<?php echo date('Y-m-d') ?>"  />
                </div>
                <div class="content-imagem">
                    <input type="file" class="form-control-file" name="capa">
                </div>
                <input type="submit" class="btn btn-primary" value="Publicar">
            </form>


      </div><!--FIM DO FORM-->
     
  </div>
</div>


<!-- Modal AVISOS -->


<div class="modal fade" id="aviso" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Criar publicação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <span id="msg" ></span>

     
     
  </div>
</div>



        </body>
</html>

<?php }else{   include('page/noticia_single.php');}  ?>

