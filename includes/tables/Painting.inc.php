<?php
class Painting {
        public $paintingID;
        public $title;
        public $artistName;
        public $imageFileName;
        public $MSRP;
        public $excerpt;
        public $galleryName;
        public $shapeName;
        public $description;
        public $year;
        public $medium;
        public $width;
        public $height;
        public $accessionNumber;
        public $copyright;
        public $galleryLink;
        public $wikiLink;
        public $googleLink;
        public $googleDescription;

        function __construct($record){
            $this->paintingID = $record['PaintingID'];
            $this->title = $record['Title'];
            $this->artistName = $record['FirstName'].' '.$record['LastName'];
            $this->imageFileName = $record['ImageFileName'];
            $this->MSRP = number_format($record['MSRP'], 0, '.', ',');
            $this->excerpt = $record['Excerpt'];
            $this->galleryName = $record['GalleryName'];
            $this->shapeName = $record['ShapeName'];
            $this->description = $record['Description'];
            $this->year = $record['YearOfWork'];
            $this->medium = $record['Medium'];
            $this->width = $record['Width'];
            $this->height = $record['Height'];
            $this->accessionNumber = $record['AccessionNumber'];
            $this->copyright = $record['CopyrightText'];
            $this->galleryLink = $record['MuseumLink'];
            $this->wikiLink = $record['WikiLink'];
            $this->googleLink = $record['GoogleLink'];
            $this->googleDescription = $record['GoogleDescription'];
        }

        public static function getNewPaint($img){
            $sql = "SELECT * FROM paintings NATURAL JOIN artists NATURAL JOIN shapes NATURAL JOIN galleries WHERE paintingID = ?";
            $final = null;
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($img));
            $pdo = null;
        
            $final = $result->fetch();
            $paintingNew = new Painting($final);
            return $paintingNew;
            }


        public static function getPaintings($artist = "", $museum = "", $shape = ""){
            $sql = "SELECT * FROM paintings NATURAL JOIN artists NATURAL JOIN shapes NATURAL JOIN galleries WHERE";
        
            $filters = "";
        
            if ($artist == "" || $artist == "Select Artist"){
                $artist = true;
                $sql = $sql." ? AND";
            } else {
                $filters = $filters." ARTIST = '".$artist."'";
                $sql = $sql." LastName = ? AND";
            }
        
            if ($museum == "" || $museum == "Select Museum"){
                $museum = true;
                $sql = $sql." ? AND";
            } else {
                $filters = $filters." MUSEUM = '".$museum."'";
                $sql = $sql." GalleryName = ? AND";
            }
        
            if ($shape == "" || $shape == "Select Shape"){
                $shape = true;
                $sql = $sql." ?";
            } else {
                $filters = $filters." SHAPE = '".$shape."'";
                $sql = $sql." ShapeName = ?";
            }
        
            if ($filters == ""){
              echo '<h4> ALL PAINTINGS [TOP 20] </h4>';
            } else {
              echo '<h4> PAINTINGS FILTERED BY'.$filters.'<br/> [TOP 20] </h4>';
            }
        
            $sql = $sql." ORDER BY YearOfWork LIMIT 20;";
        
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($artist, $museum, $shape));
            $pdo = null;
        
            $rows = $result->fetchAll();
            $paintings = Array();
            foreach($rows as $row){
                $paintings[] = new Painting($row);
            }
        
            return $paintings;
          }


    }
?>