<?php

include('MySql.php');

        class Painel{

            public static   $cargos =[
                '0' => 'Normal',
                '1' => 'Sub Administrador',
                '2' => 'Administrador'
            ];

        public static function logado(){
            //Validando se o login já está autenticado
            return isset($_SESSION['login']) ? true : false;
        }

        //Função Logout no painel
        public static function logout(){
            session_destroy();
            header('Location: '.INCLUDE_PATH);
        }
       
      

        public static function carregarPagina(){
            if(isset($_GET['url'])){
                $url = explode('/', $_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                     header('Location: '.INCLUDE_PATH_PAINEL);

                }

            }else{
                include('pages/home.php');

            }
        }

        public static function alerta($tipo,$messagem){
            if($tipo == 'sucesso'){
                echo '<h4>'.$messagem.'</h4>';
            }else if($tipo == 'erro'){
                echo '<h4>'.$messagem.'</h4>';
    
            }
        }

       

        //Validar Imagem de Cadastro
        public static function imagemValida($imagem){
            if($imagem['type'] == 'image/jpeg' ||
               $imagem['type'] == 'image/jpg' ||
               $imagem['type'] == 'image/png' ){
    
                $tamanho = $imagem['size']/1200;
                if($tamanho < 900)
                    return true;
                else
                    return false;
    
            }else{
                return false;
            }
    
        }
        //Cadastrar imagem
        public static function uploadImagem($file){
            $formato = explode('.',$file['name']);
            $imagemNome = uniqid().'.'.$formato[count($formato) - 1];
             if( move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
                return $imagemNome;
            else    
                return false;
        
        }
        //Cadastrar capa
        public static function uploadCapa($file){
            $formato = explode('.',$file['name']);
            $imagemNome = uniqid().'.'.$formato[count($formato) - 1];
             if( move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
                return $imagemNome;
            else    
                return false;
        
        }

        //Consultar 
        public static function selectAll($tabela){
            
             $sql =   MySql::conectar()->prepare("SELECT * FROM `$tabela` ");  
             $sql->execute();
    
            return $sql->fetchAll();
        }
        #Consulta especifia para retornar apenas 1 registro
        public static function select($tabela,$query,$arr){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE  $query");
            $sql->execute($arr);
            return $sql->fetch();
        }
        
        //Função atualizar
        public static function updateCadastro($arr,$single = false){
            $certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::conectar()->prepare($query.' WHERE id=? ');
					$sql->execute($parametros);
				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
    
        }

        public static function deleteImagem($file){
			@unlink('uploads/'.$file);
		}

        //Deletar Usuario
        public static function deletar($tabela,$id=false){
            if( $id == false){
                $sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
    
            }else{
                $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE  id = $id");
            }
            $sql->execute();
        }
    
        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        //Insert dinamico
        public static function insert($arr){
            $certo = true;
            $nome_tabela = $arr['nome_tabela'];
            $query = "INSERT INTO `$nome_tabela` VALUES (null";
    
            foreach($arr as $key => $value){
                $nome = $key;
                $valor = $value;
                if($nome == 'acao' || $nome == 'nome_tabela' )
                    continue;
                
                if($value == ''){
                    $certo = false;
                    break;
                }
                $query.=",?";
                $parametros[] = $value;
            }
            $query.=")";
            if($certo == true){
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
            }
           
            return $query;
        }
        
        public static function generateSlug($str){
			$str = mb_strtolower($str);
			$str = preg_replace('/(â|á|ã)/', 'a', $str);
			$str = preg_replace('/(ê|é)/', 'e', $str);
			$str = preg_replace('/(í|Í)/', 'i', $str);
			$str = preg_replace('/(ú)/', 'u', $str);
			$str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
			$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
			$str = preg_replace('/( )/', '-',$str);
			$str = preg_replace('/ç/','c',$str);
			$str = preg_replace('/(-[-]{1,})/','-',$str);
			$str = preg_replace('/(,)/','-',$str);
			$str=strtolower($str);
			return $str;
		}

    }

?>