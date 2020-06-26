<?php

if ($aViewVar['data']->execute()) {
    while ($d = $aViewVar['data']->fetch(5)){
        echo $d->nome;
    }
}