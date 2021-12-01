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
            $result = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql, Array($id));
            foreach(($query->fetchAll()) as $row){
                $result[] = new Genre($row);
            }
            return $result;  
          }
    }

?>