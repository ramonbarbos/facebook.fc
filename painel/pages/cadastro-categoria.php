<?php

 verificaPermissaoPagina(2);

?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


    <form style="width: 600px;" method="post" enctype="multipart/form-data">


    <?php

        if(isset($_POST['acao'])){
          
            $nome = @$_POST['nome'];
            if($nome == ''){
                Painel::alerta('erro','Campos vazios nao sao permitidos');   

            }else{
                $slug = Painel::generateSlug($nome);
                $arr = ['nome' => $nome, 'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categoria'];
                Painel::insert($arr);
                Painel::alerta('sucesso','Categoria cadastrada!');   

            }
            
           
        }

    ?>
  
       
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
          
       
         <a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>noticia">Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Casdastro" name="acao">

</form>

</div>
</section>
