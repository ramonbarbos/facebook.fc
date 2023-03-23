<?php

    class Componente{

        
        public static function carregarNav(){
            include('./component/nav.php');
        }

        public static function carregarSlide(){
            include('./component/slide.php');
        }

        public static function carregarNoticias(){
            include('./component/card-noticias.php');
        }

        public static function lateralNoticias(){
            include('./component/lateral-noticias.php');
        }
      
        
    }

?>
