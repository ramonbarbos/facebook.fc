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
      
    
    

        


if(!empty($dados['conteudo'])){
   

  
    

    $query = "INSERT INTO `tb_site.noticias` (conteudo , capa, data, id_user) VALUES(:conteudo, :capa, :data, :id_user)";
    $cad_coment = $conn->prepare($query);
    $cad_coment->bindParam(':conteudo', $dados['conteudo']);
    $cad_coment->bindParam(':capa', $capa);
    $cad_coment->bindParam(':data', $dados['data']);
    $cad_coment->bindParam(':id_user', $dados['id_user']);
    $cad_coment->execute();
    

    $retorna = ['erro' => false, 'msg' => 'Publicação cadastrado'];
}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao cadastrar publicação'];
}


echo json_encode($retorna);
