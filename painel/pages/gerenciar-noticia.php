
<?php



verificaPermissaoPagina(0);

if(isset($_GET['excluir'])){

    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.noticias',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticia');

}

 $noticia = Painel::selectAll('tb_site.noticias');


?>

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

        <?php 
            foreach ($noticia as $key => $value){
        ?>

    <tr>
    <td><?php echo $value['titulo'];?></td>
    <td><?php echo $value['categoria_id'];?></td>
    <td><?php echo $value['data'];?></td>
    <td><img style="width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt=""></td>
    <td><a  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-noticia?id=<?php echo $value['id']; ?>" class="btn btn-warning">Iditar</a></td>
    <td> <a <?php verificaPermissaoMenu(2) ?> type="button" class="btn btn-danger" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticia?excluir=<?php echo $value['id']; ?>">Excluir</a></td>

    </tr>
    <?php   }    ?>
</tbody>
</table>

<nav class="container">


<a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>noticia">Voltar</a>

</nav>

</div>