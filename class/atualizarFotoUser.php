<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

$file = $_FILES['imagem'];

  #VALIDANDO A IMAGEM
  if($file['type'] == 'image/jpeg' ||
  $file['type'] == 'image/jpg' ||
  $file['type'] == 'image/png' ) {
      #SE TIVER DENTRO DAS NORMAS IRÁ SER SALVA
      $formato = explode('.',$file['name']);
      $imagemNome = uniqid().'.'.$formato[count($formato) - 1];
      move_uploaded_file($file['tmp_name'],'../painel/uploads/'.$imagemNome);
        $imagem = $imagemNome ;
      
  }else{
      #SE NÃO IRÁ SER NULL
      $imagem = '' ;
  }
    
      



if(!empty($file['name'])){
   

    $query = "UPDATE  `tb_admin.usuarios` SET img = :imagem WHERE id = :id";
    $cad_coment = $conn->prepare($query);
    $cad_coment->bindParam(':id', $dados['id']);
    $cad_coment->bindParam(':imagem', $imagem);
    $cad_coment->execute();
  
    


    $retorna = ['erro' => false, 'msg' => 'Foto atualizada'];
}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao atualizar a foto de perfil'];
}


echo json_encode($retorna);
