<?php
    function checkName($login)
    {
        $json = file_get_contents('../vendor/db.json');
        $jsonArray = json_decode($json, true);
        foreach($jsonArray as $key => $value){
            for($i=0, $count=count($jsonArray); $i<$count; $i++){
                if($value[$i] === $login){
                    $name = $value[4];
                    return $name;
                }
            }
        }
    }
?>
