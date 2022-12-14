<?php
    function checkHash($login)
    {
        $json = file_get_contents('../vendor/db.json');
        $jsonArray = json_decode($json, true);
        $i = -1;
        $count=count($jsonArray);
        while($i<$count){
            $i++;
            $result = $jsonArray[$i][0];
            if($result === $login){
                $hash = $jsonArray[$i][1];
                return $hash;
            }
        }
    }
?>