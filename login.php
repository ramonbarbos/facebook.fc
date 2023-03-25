<?php
 include('painel/class/Painel.php');
 include('config.php');

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>estilos/login-register.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>_bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="img/facebook.png" type="image/x-icon">

    <title>Facebook</title>

  <body style="  background-color: #F0F2F5;">
  
    <div class="container-page">

    



            <div class="content-pagina">

                    <div class="page-1">
                        <div class="img-cont">
                          <img src="<?php echo INCLUDE_PATH ?>img/Facebook-Download-PNG.png" alt="">
                        </div>
                    </div>

                    <div class="page-2">
                        <div class="conteiner-form">
                            <form method="post">
                            <?php

                              if(isset($_POST['acao'])){

                                  //Obtendo as informações do formulario
                                  $user = $_POST['user'];
                                  $password = $_POST['password'];
                              
                                    //Fazendo a consulta no banco de dados para a Authenticação
                                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ? ");
                                    $sql->execute(array($user,$password));

                                    if($sql->rowCount() == 1){
                                        //Pegando informação no banco de dados
                                        $info = $sql->fetch();
                                        //Atribuindo as informações que esta no banco de dados para a Sessão
                                        $_SESSION['login'] = true;
                                        $_SESSION['id'] = $info['id'];
                                        $_SESSION['user'] = $user;
                                        $_SESSION['password'] = $password;
                                        $_SESSION['cargo'] = $info['cargo'];
                                        $_SESSION['nome'] = $info['nome'];
                                        $_SESSION['img'] = $info['img'];
                                        echo '<h6>Logado</h6>';
                                      
                                            header('Location: '.INCLUDE_PATH);
                                        
                                        die();
                                    }else{
                                        echo '<div class="alert alert-danger" role="alert"><h6>Usuario ou senha incorreto.</h6></div>';
                                    }

                              }

                              ?>  
                                <div class="mb-3">
                                  <input type="text" class="form-control" placeholder="Login" id="user" name="user">
                                </div>
                                <div class="mb-3">
                                  <input type="password" class="form-control"  placeholder="Senha" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                <button  type="submit" class="btn login" name="acao">Entrar</button>
                                </div>
                                <div class="mb-3">
                                    <a class="esqueceu" data-bs-toggle="modal" href="#myModalErro" role="button"><span>Esqueceu a senha?</span></a>
                                </div>

                                <div class="line"></div>
                                <div class="container-btn">
                                    <a   href="register.php" class="btn register">Criar nova conta</a>
                                </div>
                              </form>

                              
                            
                        </div>
                    </div>

            </div>
            
      </div>

      <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/popper.min.js"></script>
   <script src="<?php echo INCLUDE_PATH?>_bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<!-- Modal de aviso erro -->
<div class="modal fade" id="myModalErro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="alert alert-danger" role="alert">Em menutenção</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>