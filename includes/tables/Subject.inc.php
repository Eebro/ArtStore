<?php
class Subject{
        public $subjecteName;

        function __construct($record){
            $this->subjectName = $record['SubjectName'];
        }

        public static function getSubject($img){
            $sql = "SELECT * FROM paintings NATURAL JOIN paintingsubjects 
            INNER JOIN subjects on paintingsubjects.SubjectID = subjects.SubjectID 
            WHERE paintings.PaintingID = ?";
            $arr = array();    
            $pdo = setConnectionInfo();
            $query = runQuery($pdo,$sql,array($img));
            foreach(($query->fetchAll()) as $painting){
                $arr[] = new Subject($painting);
            }
            return $arr;
          }
    }

?>