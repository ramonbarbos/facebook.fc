<?php
    include('class/Painel.php');
    include('../config.php');
    
    //Validando se o login já está autenticado
    if(Painel::logado() == false){ 
        include('login.php');
    }else{
        if(isset($_GET['adicionar'])){     
           include('pages/cadastrar-noticia-feed.php');   

        }else if(isset($_GET['gerenciar'])){
            include('pages/gerenciar-noticia-feed.php');     
            
        }else{
            include('main.php');

        }
            
        
    }




?>