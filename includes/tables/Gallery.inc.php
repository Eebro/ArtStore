<?php
class Gallery {
        public $galleryName;

        function __construct($record){
            $this->galleryName = $record['GalleryName'];
        }

        public static function fetchMuseums(){
            $sql = "SELECT GalleryName FROM galleries ORDER BY GalleryName";
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql);
            $pdo = null;
            
            $rows = $result->fetchAll();
            $galleries = Array();
            foreach($rows as $row){
                $galleries[] = new Gallery($row);
            }
            
            return $galleries;
          }
    }
?>