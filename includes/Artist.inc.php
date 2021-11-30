<?php
class Artist {
        public $artistName;

        function __construct($record){
            $this->artistName = $record['LastName'];
        }
    }
?>
