<?php
class Genre{
        public $genreName;
        public $link;

        function __construct($record){
            $this->genreName = $record['GenreName'];
            $this->link = $record['Link'];
        }

        public static function getGenre($id){
            $sql = "SELECT * FROM paintings NATURAL JOIN paintinggenres INNER JOIN genres on paintinggenres.GenreID = genres.GenreID WHERE paintings.PaintingID = ?";
            $arr = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql, Array($id));
            foreach(($query->fetchAll()) as $row){
                $arr[] = new Genre($row);
            }
            return $arr;  
          }
    }

?>