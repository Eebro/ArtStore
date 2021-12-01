<?php
class Glass{
        public $title;
        public $price;

        function __construct($record){
            $this->title = $record['Title'];
            $this->price = number_format($record['Price'], 0, '.', ',');
        }

        public static function getGlassTypes(){
            $sql = "SELECT Title, Price FROM typesglass ORDER BY GlassID";
            $arr = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql);
            foreach(($query->fetchAll()) as $painting){
                $arr[] = new Glass($painting);
            }
            return $arr;
          }
    }

?>

