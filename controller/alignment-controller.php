<?php

require_once '../model/alignment.php';

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] == 'getResumenAlignment') {
        $alignment = new Alignment();

        echo json_encode($alignment->getResumenAlignment());
    }
}
