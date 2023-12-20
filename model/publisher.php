<?php

require_once 'Conexion.php';

class Publisher extends Conexion{

  private $pdo;
  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function getAll(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_publisher_listar");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function HerieLP($publisherId) {
    try {
      $consulta = $this->pdo->prepare("CALL spu_heroe_listar(:publisher_id)");
      $consulta->bindParam(':publisher_id', $publisherId, PDO::PARAM_INT);
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

}