<?php

namespace App\Controllers;

use App\Lib\DB;
use App\Models\Seguidor;


class SeguidorController extends Controller {
    
    public function getSeguidores(){
        $idUsuario =  \App\Lib\Auth::usuario()->id;
        $result = Seguidor::getTotalSeguidores($idUsuario);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                header('Content-Type: application/json');
                echo json_encode(array('seguidores'=> $row['total']));
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('seguidores'=> '0'));
        }
    }

}