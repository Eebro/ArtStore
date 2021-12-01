<?php
 class Shape {
        public $shapeName;

        function __construct($record){
            $this->shapeName = $record['ShapeName'];
        }

        public static function fetchShapes(){
            $sql = "SELECT ShapeName FROM shapes ORDER BY ShapeName";
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
              
            $rows = $result->fetchAll();
            $shapes = Array();
            foreach($rows as $row){
                $shapes[] = new Shape($row);
            }
              
            return $shapes;
          }
    }
?>