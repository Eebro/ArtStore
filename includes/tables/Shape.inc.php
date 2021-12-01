<?php
 class Shape {
        public $shapeName;

        function __construct($record){
            $this->shapeName = $record['ShapeName'];
        }

        public static function fetchShapes(){
            $sql = "SELECT ShapeName FROM shapes ORDER BY ShapeName";
            $arr = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo,$sql);
            foreach(($query->fetchAll()) as $painting){
                $arr[] = new Shape($painting);
            }
            return $arr;
          }
    }
?>