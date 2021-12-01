<?php
class Artist {
        public $artistName;

        function __construct($record){
            $this->artistName = $record['LastName'];
        }

        public static function getArtists(){
            $sql = "SELECT LastName FROM artists ORDER BY LastName";
            $painter = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql);
            foreach(($query->fetchAll()) as $painting){
                $painter[] = new Artist($painting);
            }
          
            return $painter;
          }
    }
?>
