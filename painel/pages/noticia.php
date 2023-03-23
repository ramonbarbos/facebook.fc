<?php

 verificaPermissaoPagina(2);

?>


<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">

   

    <form style="width: 600px;" method="post" >

    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastro-categoria">Cadastrar Categoria</a>
    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categoria" >Gerenciar Categoria</a>
    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticia">Cadastrar Noticia</a>
    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticia" >Gerenciar Noticia</a>

</form>

</div>
</section>
