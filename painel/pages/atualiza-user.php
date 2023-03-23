<?php

 verificaPermissaoPagina(2);

 if(isset($_GET['id'])){
    //Captar id da URL
    $id = (int)$_GET['id'];
    //Exibir o usuario no input 
    $user = Painel::select('tb_admin.usuarios','id=?',array($id));
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
        
            $nome = @$_POST['nome'];
            $sobrenome = @$_POST['sobrenome'];
            $senha = @$_POST['password'];
            $imagem = @$_FILES['imagem'];
            $imagem_atual = @$_POST['imagem_atual'];
            $capa = @$_FILES['capa'];
            $capa_atual = @$_POST['capa_atual'];

            if($imagem['name'] != '' ){

                if(Painel::imagemValida($imagem)){
                    
                    $imagem = Painel::uploadImagem($imagem);  
                    $capa = $capa_atual ;


                    Painel::deleteImagem($imagem_atual);

                    $arr = ['id'=>$id, 'nome' => $nome, 'sobrenome' => $sobrenome, 'password' => $senha, 'img' => $imagem, 'capa'=>$capa,'nome_tabela'=>'tb_admin.usuarios'];

                    Painel::updateCadastro($arr);
                        Painel::alerta('sucesso','Usuario Atualizada com Imagem!');  
                  //Atualizar a pagina com os dados novos
                    $user = Painel::select('tb_admin.usuarios','id=?',array($id));
                  }else{
                    Painel::alerta('erro','Formato da imagem nao é valido!');   

                  }
                

            }else if( $capa['name'] != '' ){

                if(Painel::imagemValida($capa)){
                    
                    $imagem = $imagem_atual ;
 
                    $capa = Painel::uploadCapa($capa);

                    Painel::deleteImagem($capa_atual);

                    $arr = ['id'=>$id, 'nome' => $nome, 'sobrenome' => $sobrenome, 'password' => $senha, 'img' => $imagem, 'capa'=>$capa,'nome_tabela'=>'tb_admin.usuarios'];

                    Painel::updateCadastro($arr);
                        Painel::alerta('sucesso','Usuario Atualizada com Imagem!');  
                  //Atualizar a pagina com os dados novos
                    $user = Painel::select('tb_admin.usuarios','id=?',array($id));
                  }else{
                    Painel::alerta('erro','Formato da imagem nao é valido!');   

                  }
                

            }else{
                $imagem = $imagem_atual ;
                $capa = $capa_atual ;


                $arr = ['id'=>$id, 'nome' => $nome,'sobrenome' => $sobrenome, 'password' => $senha, 'img' => $imagem, 'capa'=>$capa,'nome_tabela'=>'tb_admin.usuarios'];

                Painel::updateCadastro($arr);
                    Painel::alerta('sucesso','Usuario Atualizada com Imagem!');  
                //Atualizar a pagina com os dados novos
                $user = Painel::select('tb_admin.usuarios','id=?',array($id));
        
        }
    }

    ?>
  
     
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php  echo $user['nome'];?>"  >
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Sobrenome</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php  echo $user['sobrenome'];?>"  >
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php  echo $user['password'];?>" >
        </div>
       

        <div class="mb-3">
            <labelclass="form-label">Imagem</label>
            <input type="file" class="form-control"  name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $user['img'];?>">

        </div>

        <div class="mb-3">
            <labelclass="form-label">Capa</label>
            <input type="file" class="form-control"  name="capa">
            <input type="hidden" name="capa_atual" value="<?php echo $user['capa'];?>">

        </div>
       
       
         <a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>home">Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="acao">

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="nome_tabela" value="tb_admin.usuarios" />

</form>

</div>
</section>
