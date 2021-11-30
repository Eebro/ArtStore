<?php
 class Shape {
        public $shapeName;

        function __construct($record){
            $this->shapeName = $record['ShapeName'];
        }
    }
?>