<?php

function setConnectionInfo($values=array()) {
      // your code goes here
      try {
        if (count($values) == 3){
            $pdo = new PDO($values[0], $values[1], $values[2]);
        } else {
            $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        }

        return $pdo;

      }  catch (PDOException $e){
        die ($e->getMessage());
      }
}

function runQuery($pdo, $sql, $parameters=array())     {
    // your code goes here
    try {
        $statement = $pdo->prepare($sql);
        $i = 1;

        foreach ($parameters as $param){
            $statement->bindValue($i, $param);
            $i++;
        }


        $statement->execute();
  
        return $statement;
    }  catch (PDOException $e){
        die ($e->getMessage());
    }
}

  
?>
