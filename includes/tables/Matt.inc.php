<?php
class Matt{
        public $title;
        public $color;

        function __construct($record){
            $this->title = $record['Title'];
            $this->color = $record['ColorCode'];

        }
    }
    ?>