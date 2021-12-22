<?php
class npaluno{
    const servername = "localhost";
    const dbname = "npaluno";
    const username = "root";
    const password = "";

    public static function conectar(){
        try {
            $conn = new PDO("mysql:host=".self::servername.";dbname=".self::dbname, self::username, self::password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;    
        } catch(PDOException $pdo){
            throw new Exception("Erro ao acessar o banco de dados: ".$pdo->getMessage());
            
        }
    }
}
?>
