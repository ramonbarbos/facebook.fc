<?php
	$url = explode('/',$_GET['url']);
	

	$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticia');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticia');
	}

	//É POR QUE MINHA NOTICIA EXISTE
	$post = $post->fetch();

?>
<div  class="container mt-5">  <a class="nav-link" style="color:#329da8;" href="<?php echo INCLUDE_PATH?>noticia">Voltar</a></div>
<section class="container mt-3">
	<div class="center">
	<header>
		<h1><i class="fa fa-calendar"></i>  <?php echo $post['titulo'] ?></h1>
		<p><?php echo date('d/m/Y',strtotime($post['data']));?> </p>
	</header>
	<div class="img mt-5 mb-5">
		<img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $post['capa'] ?>" alt="Card image cap" style="width: 100%; height: 500px;" >      

	</div>

	<article class="mb-5" >
		<p style="text-align: justify;"> <?php echo $post['conteudo']; ?></p>
	</article>
	</div>
</section>