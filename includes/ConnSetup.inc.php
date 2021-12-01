<?php

function setConnectionInfo($arr=array()) {
    try {
        if (count($arr) == 3){
            $pdo = new PDO($arr[0], $arr[1], $arr[2]);
        } else {
            $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        }
        return $pdo;
      }  catch (PDOException $e){
        die ($e->getMessage());
      }
}

function runQuery($pdo, $sql, $arr=array())     {
    try {
        $i = 1;
        $result = $pdo->prepare($sql);
        foreach ($arr as $out){
            $result->bindValue($i, $out);
            $i+=1;
        }
        $result->execute();
        return $result;
    }  catch (PDOException $e){
        die ($e->getMessage());
    }
}

  
?>
