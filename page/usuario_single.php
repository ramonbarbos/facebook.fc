<?php
	$url = explode('/',$_GET['url']);

	if(isset($_GET['user'])){
		$user = $_GET['user'];
	}else if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
	}

	//BUSCANDO O USUARIO
	if(isset($_GET['user'])){
		$verifica_usuario = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? ");
		$verifica_usuario->execute(array($user));

	}else{
			$verifica_usuario = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE  id = ?");
			$verifica_usuario->execute(array($id));
		
	}
	if($verifica_usuario->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticia');
	}
	$user_info = $verifica_usuario->fetch();


	///CONSULTANDO OS POST QUE O USUARIO FEZ
	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE id_user = ? ");
	$post->execute(array($user_info['id']));
	
	
	

	//NOTICIA EXISTENTE
	$post = $post->fetchAll();
?>

	<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/style-usuario.css">
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/feed.css">
	
	</head>
	<body>

	<div id="content-perfil" ><!--PERFIL-->
		
		<div id="perfil" class="">

    <?php if( @$user_info['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) { ?>
      <a class="pelicula-perfil-user" data-bs-toggle="modal" href="#upCapa" role="button"> 

			      <div class="capa-img" >
              <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['capa']; ?>" alt="Card image cap">
            </div>
            </a>

            <?php }else{ ?>
              <div class="capa-img">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['capa']; ?>" alt="Card image cap">
            </div>
              <?php }?>

				<div class="content-card">

					<div id="card-user" class="">
					
          <?php if( @$user_info['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) { ?>
						<a class="pelicula-perfil-user" data-bs-toggle="modal"  href="#upFoto" role="button"> 
							<div class="img-user">
								<img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['img'] ?>" alt="Card image cap">
							</div>
            </a>
            <?php }else{ ?>
                <a class="pelicula-perfil-user"   > 
                <div class="img-user">
                  <img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['img'] ?>" alt="Card image cap">
                </div>
              </a>
              <?php }?>

						<div class="info-user">
							<h5 class="card-title"><b><?php echo $user_info['nome'] ?> <?php echo $user_info['sobrenome'] ?></b></h5>
							<p class="card-text"><small class="text-muted"><b>0 amigos</b></small></p>
						</div>

					</div>
				</div>	
		</div>


		
	</div><!--FIM DO PERFIL-->

	<section class="section-primary"  >

	<?php 
                    foreach($post as $key => $value) {
                     

					$user_id = $user_info['id'];
						
                     $usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));
                  ?>


	<div class="content-post"  ><!--INICIO NOTICIAS-->

						
				

			 
                        <!--INICIO USUARIO-->
                <div class="usuario" >

                    <div class="usuario-perfil" >

                      <a href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 	
                       <img class="perfil-user" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
                      </a>

                     <div class="info-usuario">
						<h6  ><?php echo @$usuario_resposavel['nome'];?></h6>
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
									<a class="dropdown-item"  >Apagar</a>

                              </div>

                            <?php   }  ?>

             </a><!--final menu-->


                </div><!--FINAL USUARIO-->

							<!--INICIO NOTICIAS-->
					<div class="card-post" >

								
							<div class="info-card">
									<p class="card-text"><?php echo substr($value['conteudo'],0,50).'...';?></p>
							
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
                    <a class="btn-comentar" onclick="listFeed(<?php echo $value['id']?>)" data-bs-toggle="modal"  href="#feedUser" role="button">
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
	<?php }	?>			
	</section>
		
<script>

async function updateImagem(id){
    
    const cadForm = document.getElementById("car-foto");
    cadForm.addEventListener("submit", async (e) =>{
    e.preventDefault(); //para não recarrecar a pagina
    console.log("chegou a requisição para ser atualizado")

    const dadosForm =  new FormData(cadForm);
    dadosForm.append("id", id)
    console.log(dadosForm)

    const dadosPubli = await fetch("./class/atualizarFotoUser.php",{
            method: "POST",
            body:dadosForm
        });


    const respostaPubli = await dadosPubli.json();
    console.log(respostaPubli)

    if(respostaPubli['erro']){
            document.getElementById('msg').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaPubli['msg']+'</div>'  ;
            
                
        }else{
            document.getElementById('msg').innerHTML ='<div class="alert alert-success" role="alert">'+respostaPubli['msg']+'</div>'  ;

        }

    
})
}


async function updateCapa(id){
    
    const cadForm = document.getElementById("car-capa");
    cadForm.addEventListener("submit", async (e) =>{
    e.preventDefault(); //para não recarrecar a pagina
    console.log("chegou a requisição para ser atualizado")

    const dadosForm =  new FormData(cadForm);
    dadosForm.append("id", id)
    console.log(dadosForm)

    const dadosPubli = await fetch("./class/atualizarCapaUser.php",{
            method: "POST",
            body:dadosForm
        });


    const respostaPubli = await dadosPubli.json();
    console.log(respostaPubli)

    if(respostaPubli['erro']){
            document.getElementById('msgCapa').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaPubli['msg']+'</div>'  ;
            
                
        }else{
            document.getElementById('msgCapa').innerHTML ='<div class="alert alert-success" role="alert">'+respostaPubli['msg']+'</div>'  ;

        }

    
})
}


</script>



	</body>
	</html>

<!-- Modal ADD FOTO -->
	

<div class="modal fade" id="upFoto" tabindex="-1" aria-labelledby="upFoto" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="upFoto">Atualizar Foto Perfil</h5>
        <button type="button" class="btn-close"  onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
      <span id="msg" ></span>

      <div class="usuario" > <!--INICIO DO FORM-->

        

            <form id="car-foto" enctype="multipart/form-data" >
            
                <div class="content-imagem">
                    <input type="file" class="form-control-file" name="imagem">
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar Foto"  onclick="updateImagem(<?php echo $user_info['id'] ?>)" >
              </form>


      </div><!--FIM DO FORM-->

      </div>
    </div>
  </div>
</div>

<!-- Modal ADD CAPA -->


<div class="modal fade" id="upCapa" aria-hidden="true" aria-labelledby="upCapa" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="upCapa">Atualizar Capa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="window.location.reload()" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
       
      <span id="msgCapa" ></span>

        <div class="usuario" > <!--INICIO DO FORM-->

          

              <form id="car-capa" enctype="multipart/form-data" >
              
                  <div class="content-imagem">
                      <input type="file" class="form-control-file" name="capa">
                  </div>
                  <input type="submit" class="btn btn-primary" value="Enviar Capa"  onclick="updateCapa(<?php echo $user_info['id'] ?>)" >
                </form>


        </div><!--FIM DO FORM-->

     </div>
  </div>
</div>
 