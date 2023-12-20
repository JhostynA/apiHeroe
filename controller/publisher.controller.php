<?php

require_once '../model/publisher.php';

if (isset($_GET['operacion'])){
  
  $publisher = new Publisher();

  if ($_GET['operacion'] == 'listar'){
    $resultado = $publisher->getAll();
    echo json_encode($resultado);
  }elseif ($_GET['operacion'] == 'listarHeroes' && isset($_GET['publisher_id'])) {
    $publisherId = $_GET['publisher_id'];
    $resultadoHeroes = $publisher->HerieLP($publisherId);
    echo json_encode($resultadoHeroes);
  }
  
}

if(isset($_GET['operacion'])){
  $publisher = new Publisher();

  if($_GET['operacion'] == 'listarPublishers'){
    $resultado = $publisher->getAll();
    echo json_encode($resultado);
  }
}