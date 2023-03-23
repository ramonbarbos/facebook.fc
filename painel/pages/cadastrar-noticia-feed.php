<?php

//verificaPermissaoPagina(0);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
   
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
<body>
    
    <section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container mt-5 mb-5" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


        <form style="width: 600px;" method="post" enctype="multipart/form-data">


        <?php
            //Pegando usuario logado para registrar no Feed
            $user = $_SESSION['user'];
        $usuario_logado = Painel::select('tb_admin.usuarios','user=?',array($user));
        $id_user = $usuario_logado['id'];

            if(isset($_POST['acao'])){

                $categoria_id = @$_POST['categoria_id'];
                $titulo = @$_POST['titulo'];
                $conteudo = @$_POST['conteudo'];
                $capa = @$_FILES['capa'];
                
                if($titulo == '' ){
                    Painel::alerta('erro','Campos vazios nao sao permitidos');   

                }else{
                    if(Painel::imagemValida($capa)){
                        
                        $imagem = Painel::uploadImagem($capa);  
                        $slug = Painel::generateSlug($titulo);
                        $arr = [ 'categoria_id'=>$categoria_id, 'titulo' => $titulo, 'conteudo' => $conteudo, 'capa' => $imagem,     'order_id'=>'0','slug'=>$slug, 'data'=>date('Y-m-d'), 'id_user'=>$id_user, 'nome_tabela'=>'tb_site.noticias',];

                        Painel::insert($arr);
                            Painel::alerta('sucesso','Noticia cadastrada!'); 
                            
                            header('Location: '.INCLUDE_PATH.'noticia');

                         }else{
                    Painel::alerta('erro','Selecione uma imagem valida!');   
                        
                    }
                    

                }
                
            
            }

        ?>
            <div class="mb-3">
            <label for="titulo" class="form-label">Categoria</label>
            <select class="form-select"  name="categoria_id">
                <?php
                    $categoria = Painel::selectAll('tb_site.categoria');
                    
                    foreach($categoria as $key => $value){

                ?>
                <option value="<?php echo $value['id']?>"><?php echo $value['nome'];  ?></option>
                <?php 
                    }
                ?>
            </select>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>

            <div class="mb-3">
                <label for="cateudo" class="form-label">Conteudo</label>
                <textarea class="tinymce" name="conteudo" id="mytextarea" ></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Capa</label>
                <input type="file" class="form-control"  name="capa">
            </div>

            <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH?>noticia">Voltar</a>

            <!--PARA CADASTROS DINAMICOS-->
            <input type="hidden" name="order_id" value="0" />
            <input type="hidden" name="nome_tabela" value="tb_site.noticias" />
            <!--CORRIGIR ERROS-->

            <input type="submit" class="btn btn-outline-dark" value="Cadastrar" name="acao">
    </form>

    </div>
    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>