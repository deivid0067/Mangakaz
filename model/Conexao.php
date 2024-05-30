<?php
    class Conexao
    {
        public static function conectar()
        {
            $conexao = new PDO("mysql:host=localhost;dbname=bdloja", "root", ""); 
            
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conexao;
        }
    }
?>