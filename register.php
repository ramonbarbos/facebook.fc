<?php
 include('painel/class/Painel.php');
 include('config.php');
 include('painel/class/Usuario.php');

?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>_bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>estilos/login-register.css">
    <link rel="shortcut icon" href="img/facebook.png" type="image/x-icon">
    <title>Facebook</title>


  </head>
  <body>
  
    <div class="container-page">

    
            <div class="content-pagina">

                    <div class="page-1">
                        <div class="img-cont">
                          <img src="<?php echo INCLUDE_PATH ?>img/Facebook-Download-PNG.png" alt="">
                        </div>
                    </div>

                    <div class="page-2">
                        <div class="conteiner-form">
                          
                            <form  id="user-form" method="post" enctype="multipart/form-data">
                            
                                  <div class="mb-3">
                                    <h3  >Cadastre-se</h3>
                                <div id="emailHelp" class="form-text">É facil e rapido.</div>
                                  </div>
                                  <div class="line"></div>

                              <!--User-->
                                <div class="mb-3">
                                  <input type="text" class="form-control"  placeholder="Login" id="user" name="user" required>
                                </div>
                                 <!--Nome-->
                                 <div class="mb-3">
                                  <input type="text" class="form-control"  placeholder="Nome"  id="nome" name="nome"required >
                                </div>
                                 <!--Sobrenome-->
                                 <div class="mb-3">
                                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required >
                                </div>
                                 <!--Senha-->
                                <div class="mb-3">
                                  <input type="password" class="form-control"  placeholder="Senha" id="password" name="password" required> 
                                </div>
                                
                                  
                                  <!--Botão enviar-->

                                <div class="container-btn">
                                  <button  type="submit" class="btn register" name="acao">Cadastre-se</button>
                              </div>
                                  <!--Voltar ao Login -->
                             
                                <div class="line"></div>
                                <div class="container-btn">
                                  <a class="esqueceu" href="login.php"><span>Ja tenho conta</span></a>

                                </div>


                              </form>

                             
                        </div>
                    </div>

            </div>
            
      </div>



<!-- Modal de aviso erro -->
<div class="modal fade" id="myModalErro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div id="msg" ></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal de aviso erro -->
<div class="modal fade" id="myModalSucesso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div id="msgSuccess" ></div>

      </div>
      <div class="modal-footer">
        <button  class="btn btn-success" onclick="window.location.href = 'login.php'" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

  
      <script >
          //NOVO USUARIO
  const userForm = document.getElementById("user-form");

    userForm.addEventListener("submit", async (e) =>{
      e.preventDefault(); //para não recarrecar a pagina
      console.log("chegou a requisição para ser adicionado")

      const dadosForm =  new FormData(userForm);
      dadosForm.append("add", 1)
      console.log(dadosForm)

      const dadosPubli = await fetch("./class/cadastrarUsuario.php",{
            method: "POST",
            body:dadosForm
        });
        const respostaCad = await dadosPubli.json();
        console.log(respostaCad);
     
        if(respostaCad['erro']){
                document.getElementById('msg').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaCad['msg']+'</div>'  ;
                var myModal = new bootstrap.Modal(document.getElementById('myModalErro'))
                myModal.show();
            }else{
                document.getElementById('msgSuccess').innerHTML ='<div class="alert alert-success" role="alert">'+respostaCad['msg']+'</div>'  ;
                document.getElementById("user-form").reset(); //resetar input
                var myModal = new bootstrap.Modal(document.getElementById('myModalSucesso'))
                myModal.show();
                
            }
     

})
      </script>

      <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/popper.min.js"></script>
   <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


