<?php

include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query =  "SELECT id, nome_user, img_user, comentario FROM `tb_site.comentario` WHERE id_noticia = :id ";
$result = $conn->prepare($query);
$result->bindParam(':id', $id);
$result->execute();

$dados = "";

while($ress = $result->fetch(PDO::FETCH_ASSOC)){
   // var_dump($ress);
    extract($ress);
    

   
    $dados .= '
                <div class="cont-user-coment">

                     <div class="content-user-coment">
                         <a class=""> 
                            <img class="perfil-user-coment" src="./painel/uploads/'.$img_user.'" alt="Card image cap"  >
                         </a>
                     </div>

                     <div class="coment">
                           <h6><b>'.$nome_user.'</b></h6>
                           <p>'.$comentario.'</p>

                    </div>
                    
                </div>

              ';



}

echo $dados;



?>