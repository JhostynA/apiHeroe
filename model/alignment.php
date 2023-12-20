<?php

require 'Conexion.php';

class Alignment extends Conexion
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = parent::getConexion();
        } catch (Exception $e) {
            throw $e; 
        }
    }

    public function getResumenAlignment()
    {
        try {
            $consulta = $this->pdo->prepare("CALL spu_resumen_alignment()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll($data = []){
        try {
          $consulta = $this->pdo->prepare("CALL spu_listar_bandosP(?)");
          $consulta->execute(
            array(
              $data['id']
            )
          );
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
          die($e->getMessage());
        }
    }
}
