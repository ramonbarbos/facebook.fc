<?php 

include_once "conexao.php";


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)){

    //Consulta Feed
    $queryFeed =  "DELETE FROM `tb_site.noticias` WHERE id = :id ";
    $resultFeed = $conn->prepare($queryFeed);
    $resultFeed->bindParam(':id', $id);
    $resultFeed->execute();
    

    
    $dados = ['erro' => false,'msg' => 'Apagado com sucesso!' ];

}else{
    $dados = ['erro' => true, 'msg' => 'Erro ao apagar'];

}

echo json_encode($dados);


?>
