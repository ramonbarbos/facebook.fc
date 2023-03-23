<?php 

include_once "conexao.php";


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)){

    //Consulta Feed
    $queryFeed =  "SELECT id, titulo, conteudo, capa, data, id_user FROM `tb_site.noticias` where id = :id ";
    $resultFeed = $conn->prepare($queryFeed);
    $resultFeed->bindParam(':id', $id);
    $resultFeed->execute();
    $ress = $resultFeed->fetch();

    $id_user = $ress['id_user'];

    //Consulta responsavel
    $queryRes =  "SELECT id, user, nome, img, capa FROM `tb_admin.usuarios` where id = :id ";
    $resultRes = $conn->prepare($queryRes);
    $resultRes->bindParam(':id', $id_user);
    $resultRes->execute();
    $resposavel = $resultRes->fetch();

    
    $dados = ['erro' => false, 'dados-feed' => $ress,'dados-res' => $resposavel];

}else{
    $dados = ['erro' => true, 'msg' => 'Erro no tramite'];

}

echo json_encode($dados);


?>
