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

        public static function getReviews($id){
            $sql = "SELECT * FROM reviews WHERE PaintingID = ?";
              
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($id));
            $pdo = null;
        
            $rows = $result->fetchAll();
            $reviews = Array();
            foreach($rows as $row){
                $reviews[] = new Review($row);
            }  
        
            return $reviews;
          }
        
         
          public static function getAvgReview($id){
            $sql = "SELECT AVG(Rating) FROM reviews GROUP BY PaintingID HAVING PaintingID = ?";
              
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($id));
            $pdo = null;
        
            $rating = $result->fetch();
            $final = round($rating[0]);
            return $final;
          }   
    }
    ?>