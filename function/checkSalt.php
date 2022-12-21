<?php
    function checkSalt($login)
    {
        $json = file_get_contents('../vendor/db.json');
        $jsonArray = json_decode($json, true);
        foreach($jsonArray as $key => $value){
            for($i=0, $count=count($jsonArray); $i<$count; $i++){
                if($value[$i] === $login){
                    $salt = $value[2];
                    return $salt;
                }
            }
        }
    }
?>