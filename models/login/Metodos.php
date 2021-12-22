<?php
include_once "../../Conectar.class.php";

class util
{

    public function auditoria($rotina, $usuario, $ip)
    {
       try {
            #Conecta no banco de dados
            $con = npaluno::conectar();
            #inserção de auditoria
            $sql = "insert into auditoria (id, rotina, usuario, data, ip) values (id, ?, ?, now(), ?)";
            $stm = $con->prepare($sql);
            $stm->bindValue(1,$rotina);
            $stm->bindValue(2,$usuario);
            $stm->bindValue(3,$ip);
            $stm->execute();
        } catch (PDOException $p){
            throw new Exception ("Ocorreu um erro ao tentar salvar a auditoria: ". $p->getMessage());
        }
    }

}
?>