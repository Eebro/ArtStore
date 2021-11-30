<?php
class Gallery {
        public $galleryName;

        function __construct($record){
            $this->galleryName = $record['GalleryName'];
        }
    }
?>