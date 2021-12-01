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
            $arr = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql);
            foreach(($query->fetchAll()) as $painting){
                $arr[] = new Matt($painting);
            }
            return $arr;
          }
    }
    ?>