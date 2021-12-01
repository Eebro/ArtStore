<?php
class Subject{
        public $subjecteName;

        function __construct($record){
            $this->subjectName = $record['SubjectName'];
        }

        public static function findPaintingSubjects($id){
            $sql = "SELECT * FROM paintings NATURAL JOIN paintingsubjects 
            INNER JOIN subjects on paintingsubjects.SubjectID = subjects.SubjectID 
            WHERE paintings.PaintingID = ?";
            $arr = array();    
            $pdo = setConnectionInfo();
            $result = runQuery($pdo,$sql,array($id));
            foreach(($result->fetchAll()) as $painting){
                $arr[] = new Subject($painting);
            }
            return $arr;
          }
    }

?>