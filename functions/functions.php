<?php

function CreateHash($values, $IntegrationKey) {
    $string = "";

    foreach($values as $key=>$value) {
        if( strtoupper($key) != "HASH" ){
            $string .= $value;
        }
    }

    $string .= $IntegrationKey;
    $hash = hash("sha512", $string);

    return strtoupper($hash);
}
