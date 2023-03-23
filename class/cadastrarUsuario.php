<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

  #IMAGEM PADRÃO
  $dir =scandir('../img/');
  $img = $dir[8]  ;
  $imagem = $img ;
 #CAPA PADRÃO
 $dir_2 =scandir('../img/');
 $cp = $dir_2[3]  ;
 $capa = $cp ;



if(!empty($dados['user'])){

    #VERIFICAR SE O USUARIO EXISTE
    $sql = $conn->prepare('SELECT id FROM `tb_admin.usuarios` WHERE   user = ?');
    $sql->execute(array($dados['user']));
    if($sql->rowCount() == 1){

        $msg ="Esse login ja existe";
        $retorna = ['erro' => true, 'msg' => $msg];
        

    }else{

        $query = "INSERT INTO `tb_admin.usuarios` (user, nome, sobrenome, password, img, capa) VALUES(:user, :nome, :sobrenome, :password,  :img, :capa)";
        $cad_user = $conn->prepare($query);
        $cad_user->bindParam(':user', $dados['user']);
        $cad_user->bindParam(':nome', $dados['nome']);
        $cad_user->bindParam(':sobrenome', $dados['sobrenome']);
        $cad_user->bindParam(':password', $dados['password']);
        $cad_user->bindParam(':img',  $imagem);
        $cad_user->bindParam(':capa',  $capa);
        $cad_user->execute();




        $msg ="Cadastrado com sucesso";
        $retorna = ['erro' => false, 'msg' => $msg ];

    }

   


}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao cadastrar'];

}




echo json_encode($retorna);

