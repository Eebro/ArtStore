<?php
class Subject{
        public $subjecteName;

        function __construct($record){
            $this->subjectName = $record['SubjectName'];
        }
    }

?>