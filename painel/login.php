<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilos/login-register.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>_bootstrap/css/bootstrap.css">

  <body>
  
    <div class="container-page">

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
                    if(isset($_GET['adicionar'])){
                        header('Location: '.INCLUDE_PATH.'noticia');
                    }else if(isset($_GET['gerenciar'])){
                        header('Location: '.INCLUDE_PATH.'noticia');

                    }else if(isset($_GET['user'])){
                        header('Location: '.INCLUDE_PATH);
                      
                    }else{
                        header('Location: '.INCLUDE_PATH_PAINEL);
                    }
                    die();
                }else{
                    echo '<h6>Usuario ou senha incorreto.</h6>';
                }

            }
            
        ?>



            <div class="content-pagina">

                    <div class="page-1">
                        <div class="img-cont">
                          <img src="<?php echo INCLUDE_PATH ?>img/Facebook-Download-PNG.png" alt="">
                        </div>
                    </div>

                    <div class="page-2">
                        <div class="conteiner-form">
                            <form method="post">
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
                                    <a class="esqueceu" href="#"><span>Esqueceu a senha?</span></a>
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