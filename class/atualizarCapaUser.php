<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

$file = $_FILES['capa'];

  #VALIDANDO A IMAGEM
  if($file['type'] == 'image/jpeg' ||
  $file['type'] == 'image/jpg' ||
  $file['type'] == 'image/png' ) {
      #SE TIVER DENTRO DAS NORMAS IRÁ SER SALVA
      $formato = explode('.',$file['name']);
      $imagemNome = uniqid().'.'.$formato[count($formato) - 1];
      move_uploaded_file($file['tmp_name'],'../painel/uploads/'.$imagemNome);
        $capa = $imagemNome ;
      
  }else{
      #SE NÃO IRÁ SER NULL
      $capa = '' ;
  }
    
      



if(!empty($file['name'])){
   

    $query = "UPDATE  `tb_admin.usuarios` SET capa = :capa WHERE id = :id";
    $cad_coment = $conn->prepare($query);
    $cad_coment->bindParam(':id', $dados['id']);
    $cad_coment->bindParam(':capa', $capa);
    $cad_coment->execute();
  
    


    $retorna = ['erro' => false, 'msg' => 'Capa atualizada'];
}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao atualizar a capa de perfil'];
}


echo json_encode($retorna);
