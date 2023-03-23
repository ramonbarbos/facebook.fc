<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

if(!empty($dados['comentario'])){
    
    $query = "INSERT INTO `tb_site.comentario` (id_noticia, id_user, nome_user,img_user, comentario,data) VALUES(:id_noticia, :id_user, :nome_user, :img_user, :comentario, :data)";
    $cad_coment = $conn->prepare($query);
    $cad_coment->bindParam(':id_noticia', $dados['id_noticia']);
    $cad_coment->bindParam(':id_user', $dados['id_user']);
    $cad_coment->bindParam(':nome_user', $dados['nome_user']);
    $cad_coment->bindParam(':img_user', $dados['img_user']);
    $cad_coment->bindParam(':comentario', $dados['comentario']);
    $cad_coment->bindParam(':data', $dados['data']);
    $cad_coment->execute();

    $cad_coment = $cad_coment->fetch(PDO::FETCH_ASSOC);

   
   

   

    $dadosPubli = '
                    <div class="cont-user-coment">

                            <div class="content-user-coment">
                                <a class=""> 
                                <img class="perfil-user-coment" src="./painel/uploads/'.$dados['img_user'].'" alt="Card image cap"  >
                                </a>
                            </div>

                            <div class="coment">
                                <h6><b>'.$dados['nome_user'].'</b></h6>
                                <p>'.$dados['comentario'].'</p>

                        </div>
                
                </div>
    ';


    $retorna = ['erro' => false, 'msg' => 'Comentario cadastrado', 'dados' => $dadosPubli];

}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao cadastrar'];

}




echo json_encode($retorna);
