<?php 

        class Usuario{

            //Verificar usuarios existentes
            public static function  userExists($user){
                $sql = MySql::conectar()->prepare('SELECT id FROM `tb_admin.usuarios` WHERE   user = ?');
                $sql->execute(array($user));
                if($sql->rowCount() == 1)
                    return true;
                else
                    return false;
                }

                //Cadastro Usuarios
                public static function cadastrarUsuario($user,$nome,$sobrenome,$senha,$cargo,$imagem,$capa){
                    $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?,?,?) ");
                    $sql->execute(array($user,$nome,$sobrenome,$senha,$cargo,$imagem,$capa));
        
                }

                //Atualiza Usuario
                public function atualizarUsuario($nome,$senha,$imagem){
                    $sql = MySql::conectar()->prepare('UPDATE `tb_admin.usuarios` SET   nome = ?, password = ?, img = ? WHERE user = ? ');
                    if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
                        return true;
                    }else{
                        return false;
                    }
                }

        }

?>  