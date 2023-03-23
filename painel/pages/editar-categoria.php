<?php

 verificaPermissaoPagina(2);

 if(isset($_GET['id'])){
    //Captar id da URL
    $id = (int)$_GET['id'];
    //Exibir o usuario no input 
    $categoria = Painel::select('tb_site.categoria','id=?',array($id));
}else{
    //Se o ID não for informado irá da a tela de erro 
    Painel::alerta('erro','Voce precisa passar o id!');   
    die();
}

?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


    <form style="width: 600px;" method="post" enctype="multipart/form-data">


    <?php
        if(isset($_POST['acao'])){
            //Enviei o meu formulario

            $slug = Painel::generateSlug($_POST['nome']);
            $arr = array_merge($_POST, array('slug'=>$slug));
            $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE nome = ? AND id != ?");
            $verificar->execute(array($_POST['nome'],$id));
            if($verificar->rowCount() == 1){
                Painel::alerta('erro','Ja existe uma categoria com este nome!');   
                
            }else{
                if(Painel::updateCadastro($arr)){
                    Painel::alerta('sucesso','A atualização da categoria foi feito com sucesso!');   
                    $categoria = Painel::select('tb_site.categoria','id=?',array($id));
                    
                }else{
                    Painel::alerta('erro','Campos vazios nao sao permitidos');   
                }
            }
           
        
        

        }
        

    ?>
  
     
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php  echo $categoria['nome'];?>"  >
        </div>
        
    
       
         <a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>cadastro">Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="acao">

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="nome_tabela" value="tb_site.categoria" />

</form>

</div>
</section>
