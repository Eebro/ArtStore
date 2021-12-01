<?php
class Matt{
        public $title;
        public $color;

        function __construct($record){
            $this->title = $record['Title'];
            $this->color = $record['ColorCode'];

        }

        public static function getMattTypes(){
            $sql = "SELECT Title, ColorCode FROM typesmatt ORDER BY MattID";
            
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
                
            $rows = $result->fetchAll();
            $matts = Array();
            foreach($rows as $row){
                $matts[] = new Matt($row);
            }
          
            return $matts;
          }
        
    }
    ?>