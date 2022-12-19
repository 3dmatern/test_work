<?php
    function checkHash($login)
    {
        $json = file_get_contents('../vendor/db.json');
        $jsonArray = json_decode($json, true);
        foreach($jsonArray as $key => $value){
            for($i=0, $count=count($jsonArray); $i<$count; $i++){
                if($value[$i] === $login){
                    $hash = $value[1];
                    return $hash;
                }
            }
        }
    }
?>
