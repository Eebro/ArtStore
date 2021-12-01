<?php
class Artist {
        public $artistName;

        function __construct($record){
            $this->artistName = $record['LastName'];
        }

        public static function fetchArtists(){
            $sql = "SELECT LastName FROM artists ORDER BY LastName";
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
          
            $rows = $result->fetchAll();
            $artists = Array();
            foreach($rows as $row){
                $artists[] = new Artist($row);
            }
          
            return $artists;
          }
    }
?>
