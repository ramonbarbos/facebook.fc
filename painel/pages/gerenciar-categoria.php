
<?php



verificaPermissaoPagina(0);

if(isset($_GET['excluir'])){

    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.categoria',$idExcluir);

     //Apagando a categoria apagara todas as noticias vinculadas
    $noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));
		$noticias = $noticias->fetchAll();
		foreach ($noticias as $key => $value) {
			$imgDelete = $value['capa'];
			Painel::deleteImagem($imgDelete);
		}
		$noticias = MySql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));

    Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categoria');

}

 $categoria = Painel::selectAll('tb_site.categoria');


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
    <th scope="col">Nome</th>
    <th scope="col">#</th>
    <th scope="col">#</th>
 
    </tr>
</thead>

<tbody>

        <?php 
            foreach ($categoria as $key => $value){
        ?>

    <tr>
    <td><?php echo $value['nome'];?></td>
    <td><a  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id']; ?>" class="btn btn-warning">Iditar</a></td>
    <td> <a <?php verificaPermissaoMenu(2) ?> type="button" class="btn btn-danger" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categoria?excluir=<?php echo $value['id']; ?>">Excluir</a></td>

    </tr>
    <?php   }    ?>
</tbody>
</table>

<nav class="container">


<a class="btn btn-outline-primary" href="<?php INCLUDE_PATH_PAINEL ?>noticia">Voltar</a>

</nav>

</div>