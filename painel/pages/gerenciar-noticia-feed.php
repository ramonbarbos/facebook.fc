
<?php



if(isset($_GET['gerenciar']) || isset($_GET['gerenciar&excluir']))
$id = (int)$_GET['gerenciar']; 
$noticia = Painel::select('tb_site.noticias','id=?',array($id));
$user_id = $noticia['id_user'];
$usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));

if( @$usuario_resposavel['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) {

if(isset($_GET['excluir'])){

    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.noticias',$idExcluir);


    Painel::redirect(INCLUDE_PATH.'noticia');

}




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <!--TINYMCE-->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOME_SITE?></title>
</head>
<body style="width:100vw;height:100vh;display:flex;justify-content: center; ">
    
                    <div class="container-sm" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">

                    <form style="width: 600px;" method="post" enctype="multipart/form-data">

                    <?php  
                    if(isset($_POST['acao'])){

                    }
                    ?>

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Data</th>
                        <th scope="col">Capa</th>
                    
                        </tr>
                    </thead>

                    <tbody>

                        

                        <tr>
                        <td><?php echo $noticia['titulo']?></td>
                        <td><?php echo $noticia['categoria_id'];?></td>
                        <td><?php echo $noticia['data'];?></td>
                        <td><img style="width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $noticia['capa'] ?>" alt=""></td>
                        <td><a  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-noticia-feed?id=<?php echo $noticia['id']; ?>" class="btn btn-warning">Iditar</a></td>
                        <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                          Excluir
                        </button></td>
                                                
                        </tr>
                     
                    </tbody>
                    </table>

                    <nav class="container">


                    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH?>noticia">Voltar</a>

                    </nav>

                    </div>

 

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Tem certeza que deseja excluir?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      
                        <a  type="button" class="btn btn-danger" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticia-feed?gerenciar=<?php echo $noticia['id']; ?>&excluir=<?php echo $noticia['id']; ?>">Sim</a>


                      </div>
                    </div>
                  </div>
                </div>

                     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php }else{     header('Location: '.INCLUDE_PATH.'noticia'); }?>

