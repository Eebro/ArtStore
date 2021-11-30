<?php
class Review{
        public $date;
        public $rating;
        public $comment;

        function __construct($record){
            $this->date = date_format(date_create($record["ReviewDate"]), "m/d/Y");
            $this->rating = $record['Rating'];
            $this->comment = $record['Comment'];
        }
    }
    ?>