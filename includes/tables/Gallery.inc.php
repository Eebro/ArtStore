<?php
class Gallery {
        public $galleryName;

        function __construct($record){
            $this->galleryName = $record['GalleryName'];
        }

        public static function fetchMuseums(){
            $sql = "SELECT GalleryName FROM galleries ORDER BY GalleryName";
            $result = array();
            $pdo = setConnectionInfo();
            $query = runQuery($pdo, $sql);
            foreach(($query->fetchAll()) as $painting){
                $result[] = new Gallery($painting);
            }
            return $result;
          }
    }
?>