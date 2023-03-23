
<?php



if(isset($_GET['excluir'])){
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_admin.usuarios',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'home');

}

 $cadastros = Painel::selectAll('tb_admin.usuarios');


?>

<section style="width:100vw;height:100vh;display:flex;justify-content: center; " >

            <div class="container-sm" style="border-radius: 7px; background-color: white; display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">

            <form style="width: 600px;" method="post" enctype="multipart/form-data">

            <?php  
            if(isset($_POST['acao'])){

            }
            ?>

            <table class="table">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cargo</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
            
                </tr>
            </thead>

            <tbody>

                    <?php 
                        foreach ($cadastros as $key => $value){
                    ?>

                <tr>
                <td><?php echo $value['nome'];?></td>
                <td><?php echo $value['cargo'];?></td>
                <td><a  <?php verificaPermissaoMenu(2) ?> href="<?php echo INCLUDE_PATH_PAINEL ?>atualiza-user?id=<?php echo $value['id']; ?>" class="btn btn-warning">Iditar</a></td>
                <td> <a <?php verificaPermissaoMenu(2) ?> type="button" class="btn btn-danger" href="<?php echo INCLUDE_PATH_PAINEL ?>home?excluir=<?php echo $value['id']; ?>">Excluir</a></td>

                </tr>
                <?php   }    ?>
            </tbody>
            </table>

            <nav class="container">



            <ul class="pagination pagination-sm">
            
            
            </ul>
            </nav>

            </div>
</section>