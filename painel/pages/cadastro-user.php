<?php

 verificaPermissaoPagina(2);

?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


    <form style="width: 600px;" method="post" enctype="multipart/form-data">


    <?php

        if(isset($_POST['acao'])){
            $login = @$_POST['user'];
            $nome = @$_POST['nome'];
            $senha = @$_POST['password'];
            $cargo = @$_POST['cargo'];
            $imagem = @$_FILES['imagem'];
            $capa = @$_FILES['capa'];
            
            if(Usuario::userExists($login)){
                //Se não existe ele irá dar erro
                Painel::alerta('erro','O login ja existe!');
            }else{
                //Cadastrar 
                $usuario =  new Usuario();
                $imagem = Painel::uploadImagem($imagem);
                $capa = Painel::uploadCapa($capa);
                $usuario->cadastrarUsuario($login,$nome,$sobrenome,$senha,$cargo,$imagem,$capa);
                Painel::alerta('sucesso','O cadastro foi feito com sucesso!');

            } 
        }

    ?>
  
        <div class="mb-3">
            <label for="user" class="form-label">Login</label>
            <input type="text" class="form-control" id="user" name="user" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <select name="cargo" id="cargo">
            <?php 
                        foreach (Painel::$cargos as $key => $value){
                            if($key < $_SESSION['cargo'])  echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    ?>
            </select>
        </div>
        <div class="mb-3">
            <labelclass="form-label">Imagem</label>
            <input type="file" class="form-control"  name="imagem">
        </div>
        <div class="mb-3">
            <labelclass="form-label">Capa</label>
            <input type="file" class="form-control"  name="capa">
        </div>
       
         <a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>cadastro">Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Casdastro" name="acao">

</form>

</div>
</section>
