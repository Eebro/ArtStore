<?php
class Genre{
        public $genreName;
        public $link;

        function __construct($record){
            $this->genreName = $record['GenreName'];
            $this->link = $record['Link'];
        }

        public static function findPaintingGenres($id){
            $sql = "SELECT * FROM paintings NATURAL JOIN paintinggenres INNER JOIN genres on paintinggenres.GenreID = genres.GenreID WHERE paintings.PaintingID = ?";
              
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($id));
            $pdo = null;
            
            $rows = $result->fetchAll();
            $genres = Array();
            foreach($rows as $row){
                $genres[] = new Genre($row);
            }
              
            return $genres;  
          }
    }

?>