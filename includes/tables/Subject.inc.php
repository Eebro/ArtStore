<?php
class Subject{
        public $subjecteName;

        function __construct($record){
            $this->subjectName = $record['SubjectName'];
        }

        public static function findPaintingSubjects($id){
            $sql = "SELECT * FROM paintings NATURAL JOIN paintingsubjects INNER JOIN subjects on paintingsubjects.SubjectID = subjects.SubjectID WHERE paintings.PaintingID = ?";
            
            $pdo = setConnectionInfo();
            $result = runQuery($pdo, $sql, Array($id));
            $pdo = null;
              
            $rows = $result->fetchAll();
            $subjects = Array();
            foreach($rows as $row){
                $subjects[] = new Subject($row);
            }
        
            return $subjects;
          }
    }

?>