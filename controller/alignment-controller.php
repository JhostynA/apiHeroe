<?php

require_once '../model/alignment.php';

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] == 'getResumenAlignment') {
        $alignment = new Alignment();

        echo json_encode($alignment->getResumenAlignment());
    }
}


if (isset($_POST['operacion'])) {
    $alignment = new Alignment();
  
    if ($_POST['operacion'] == 'listarBandosP') {
      $publisherId = [
        "id" => $_POST["id"]
      ];
      $result = $alignment->getAll($publisherId);
      echo json_encode($result);
    }
}