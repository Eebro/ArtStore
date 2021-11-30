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
    }
?>