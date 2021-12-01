<?php
class Review{
        public $date;
        public $rating;
        public $comment;

        function __construct($record){
            $this->date = date_format(date_create($record["ReviewDate"]), "m/d/Y");
            $this->rating = $record['Rating'];
            $this->comment = $record['Comment'];
        }

        public static function Reviews($img){
            $sql = "SELECT * FROM reviews WHERE PaintingID = ?";
            $arr = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo,$sql,array($img));
            foreach(($query->fetchAll()) as $painting){
                $arr[] = new Review($painting);
            }  
            return $arr;
          }
        
         
          public static function PaintReview($img){
            $sql = "SELECT AVG(Rating) FROM reviews GROUP BY PaintingID HAVING PaintingID = ?";
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql,array($img));
            $pdo = null;
            $final = round(($query->fetch())[0]);
            return $final;
          }   
    }
    ?>