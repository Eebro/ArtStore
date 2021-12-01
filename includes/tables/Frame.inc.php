<?php
class Frame{
        public $title;
        public $price;

        function __construct($record){
            $this->title = $record['Title'];
            $this->price = number_format($record['Price'], 0, '.', ',');
        }

        public static function Frames(){
            $sql = "SELECT Title, Price FROM typesframes ORDER BY FrameID";
            $result = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql);
            foreach(($query->fetchAll()) as $painting){
                $result[] = new Frame($painting);
            }
            return $result;
          }
    }

?>