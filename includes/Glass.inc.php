<?php
class Glass{
        public $title;
        public $price;

        function __construct($record){
            $this->title = $record['Title'];
            $this->price = number_format($record['Price'], 0, '.', ',');
        }
    }

?>

