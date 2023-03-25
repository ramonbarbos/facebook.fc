<?php 

    

    session_start();


    #VARIAVEIS do VirtualHost 
    /*
    define('NOME_SITE','Facebook');
    define('INCLUDE_PATH','http://facebook.fc/');
    define('INCLUDE_PATH_LOGIN','http://facebook.fc/login');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
    define('BASE_DIR_PAINEL',__DIR__.'/painel');
*/
    #VARIAVEIS
    define('NOME_SITE','Facebook');
    define('INCLUDE_PATH','http://localhost/facebook.fc/');
    define('INCLUDE_PATH_LOGIN','http://localhost/facebook.fc/login');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
    define('BASE_DIR_PAINEL',__DIR__.'/painel');
   

    #VARIAVEIS DO BANCO DE DADOS
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','site_1');

    //Funcoes
      function pegaCargo($cargo){
       
        return Painel::$cargos[$cargo];
    }

    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            include('painel/pages/permissao-negada.php');
            die();
        }
    }

?>