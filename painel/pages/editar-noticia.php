<?php

 verificaPermissaoPagina(2);

 if(isset($_GET['id'])){
    //Captar id da URL
    $id = (int)$_GET['id'];
    //Exibir o usuario no input 
    $noticia = Painel::select('tb_site.noticias','id=?',array($id));
}else{
    //Se o ID não for informado irá da a tela de erro 
    Painel::alerta('erro','Voce precisa passar o id!');   
    die();
}

?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100%;">

<div class="container mt-5 mb-5" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


    <form style="width: 600px;" method="post" enctype="multipart/form-data">


    <?php
        if(isset($_POST['acao'])){
            //Enviei o meu formulario

            $titulo = @$_POST['titulo'];
            $conteudo = @$_POST['conteudo'];
            $capa = @$_FILES['capa'];
            $capa_atual = @$_POST['capa_atual'];
            $categoria = @$_POST['categoria_id'];
            echo $categoria;
       

            if($capa['name'] != '' ){

                if(Painel::imagemValida($capa)){
                    
                    $imagem = Painel::uploadImagem($capa);  

                    $slug = Painel::generateSlug($titulo);

                    $arr = [ 'id'=>$id,'categoria_id'=>$categoria,'titulo' => $titulo, 'conteudo' => $conteudo, 'capa' => $imagem,   'slug'=>$slug,'nome_tabela'=>'tb_site.noticias'];

                    Painel::updateCadastro($arr);
                        Painel::alerta('sucesso','Noticia Atualizada com capa!');  

                    $noticia = Painel::select('tb_site.noticias','id=?',array($id));

                  }else{
                    Painel::alerta('erro','Formato da imagem nao é valido!');   

                  }
                

            }else{
               $imagem = $capa_atual;
               
               $slug = Painel::generateSlug($titulo);

               $arr = [  'categoria_id'=>$categoria,'titulo' => $titulo, 'conteudo' => $conteudo, 'capa' => $imagem, 'id'=>$id,  'slug'=>$slug,'nome_tabela'=>'tb_site.noticias'];

               Painel::updateCadastro($arr);
                   Painel::alerta('sucesso','Noticia Atualizada!');  

                 $noticia = Painel::select('tb_site.noticias','id=?',array($id));
                }
                
        

        }
        

    ?>
  
     
        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php  echo $noticia['titulo'];?>"  >
        </div>
        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteudo</label>
            <textarea  name="conteudo" id="mytextarea"  class="form-control" ><?php  echo $noticia['conteudo'];?></textarea>

        </div>
        
        <div class="mb-3">
            <label class="form-label">Capa</label>
            <input type="file" class="form-control"  name="capa">
            <input type="hidden" name="capa_atual" value="<?php echo $noticia['capa']; ?>" >

        </div>

        <div class="mb-3">
        <label for="titulo" class="form-label">Categoria</label>
        <select class="form-select"  name="categoria_id">
            <?php
                $categoria = Painel::selectAll('tb_site.categoria');
                 
                foreach($categoria as $key => $value){

            ?>
            <option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
            <?php 
                }
            ?>
        </select>
        </div>
       
         <a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>noticia">Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="acao">

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="nome_tabela" value="tb_site.noticias" />

</form>

</div>
</section>
