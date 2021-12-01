<?php
class Frame{
        public $title;
        public $price;

        function __construct($record){
            $this->title = $record['Title'];
            $this->price = number_format($record['Price'], 0, '.', ',');
        }

        public static function getFrameTypes(){
            $sql = "SELECT Title, Price FROM typesframes ORDER BY FrameID";
            
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
                
            $rows = $result->fetchAll();
            $frames = Array();
            foreach($rows as $row){
                $frames[] = new Frame($row);
            }
          
            return $frames;
          }
    }

?>