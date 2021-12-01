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
            
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
                
            $rows = $result->fetchAll();
            $glasses = Array();
            foreach($rows as $row){
                $glasses[] = new Glass($row);
            }
          
            return $glasses;
          }
    }

?>

