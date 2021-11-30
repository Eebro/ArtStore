<?php
class Genre{
        public $genreName;
        public $link;

        function __construct($record){
            $this->genreName = $record['GenreName'];
            $this->link = $record['Link'];
        }
    }

?>