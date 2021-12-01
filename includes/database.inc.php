<?php

function setConnectionInfo($values=array()) {
      // your code goes here
      try {
        if (count($values) == 3){
            $pdo = new PDO($values[0], $values[1], $values[2]);
        } else {
            $pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);
        }

        return $pdo;

      }  catch (PDOException $e){
        die ($e->getMessage());
      }
}

function runQuery($pdo, $sql, $parameters=array())     {
    // your code goes here
    try {
        $statement = $pdo->prepare($sql);
        $i = 1;

        foreach ($parameters as $param){
            $statement->bindValue($i, $param);
            $i++;
        }


        $statement->execute();
  
        return $statement;
    }  catch (PDOException $e){
        die ($e->getMessage());
    }
}



/*
function fetchPaintings($artist = "", $museum = "", $shape = ""){
    $sql = "SELECT * FROM paintings NATURAL JOIN artists NATURAL JOIN shapes NATURAL JOIN galleries WHERE";

    $filters = "";

    if ($artist == "" || $artist == "Select Artist"){
        $artist = true;
        $sql = $sql." ? AND";
    } else {
        $filters = $filters." ARTIST = '".$artist."'";
        $sql = $sql." LastName = ? AND";
    }

    if ($museum == "" || $museum == "Select Museum"){
        $museum = true;
        $sql = $sql." ? AND";
    } else {
        $filters = $filters." MUSEUM = '".$museum."'";
        $sql = $sql." GalleryName = ? AND";
    }

    if ($shape == "" || $shape == "Select Shape"){
        $shape = true;
        $sql = $sql." ?";
    } else {
        $filters = $filters." SHAPE = '".$shape."'";
        $sql = $sql." ShapeName = ?";
    }

    if ($filters == ""){
      echo '<h4> ALL PAINTINGS [TOP 20] </h4>';
    } else {
      echo '<h4> PAINTINGS FILTERED BY'.$filters.'<br/> [TOP 20] </h4>';
    }

    $sql = $sql." ORDER BY YearOfWork LIMIT 20;";

    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql, Array($artist, $museum, $shape));
    $pdo = null;

    $rows = $result->fetchAll();
    $paintings = Array();
    foreach($rows as $row){
        $paintings[] = new Painting($row);
    }

    return $paintings;
  }
 */

/*
  function fetchArtists(){
    $sql = "SELECT LastName FROM artists ORDER BY LastName";
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
  
    $rows = $result->fetchAll();
    $artists = Array();
    foreach($rows as $row){
        $artists[] = new Artist($row);
    }
  
    return $artists;
  }
  */

/*
  function fetchMuseums(){
    $sql = "SELECT GalleryName FROM galleries ORDER BY GalleryName";
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
    
    $rows = $result->fetchAll();
    $galleries = Array();
    foreach($rows as $row){
        $galleries[] = new Gallery($row);
    }
    
    return $galleries;
  }

  
  function fetchShapes(){
    $sql = "SELECT ShapeName FROM shapes ORDER BY ShapeName";
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
      
    $rows = $result->fetchAll();
    $shapes = Array();
    foreach($rows as $row){
        $shapes[] = new Shape($row);
    }
      
    return $shapes;
  }
*/

/*
  function getPaintingById($id){
    $sql = "SELECT * FROM paintings NATURAL JOIN artists NATURAL JOIN shapes NATURAL JOIN galleries WHERE paintingID = ?";

    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql, Array($id));
    $pdo = null;
    
    return new Painting($result->fetch());
  }


  function findPaintingGenres($id){
    $sql = "SELECT * FROM paintings NATURAL JOIN paintinggenres INNER JOIN genres on paintinggenres.GenreID = genres.GenreID WHERE paintings.PaintingID = ?";
      
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql, Array($id));
    $pdo = null;
    
    $rows = $result->fetchAll();
    $genres = Array();
    foreach($rows as $row){
        $genres[] = new Genre($row);
    }
      
    return $genres;  
  }

  function findPaintingSubjects($id){
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
*/

 /*
  function getFrameTypes(){
    $sql = "SELECT Title, Price FROM typesframes ORDER BY FrameID";
    
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
        
    $rows = $result->fetchAll();
    $frames = Array();
    foreach($rows as $row){
        $frames[] = new Frame($row);
    }
  
    return $frames;
  }
*/
/*
  function getGlassTypes(){
    $sql = "SELECT Title, Price FROM typesglass ORDER BY GlassID";
    
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
        
    $rows = $result->fetchAll();
    $glasses = Array();
    foreach($rows as $row){
        $glasses[] = new Glass($row);
    }
  
    return $glasses;
  }


  function getMattTypes(){
    $sql = "SELECT Title, ColorCode FROM typesmatt ORDER BY MattID";
    
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql);
    $pdo = null;
        
    $rows = $result->fetchAll();
    $matts = Array();
    foreach($rows as $row){
        $matts[] = new Matt($row);
    }
  
    return $matts;
  }


  function getReviews($id){
    $sql = "SELECT * FROM reviews WHERE PaintingID = ?";
      
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql, Array($id));
    $pdo = null;

    $rows = $result->fetchAll();
    $reviews = Array();
    foreach($rows as $row){
        $reviews[] = new Review($row);
    }  

    return $reviews;
  }


  function getAvgReview($id){
    $sql = "SELECT AVG(Rating) FROM reviews GROUP BY PaintingID HAVING PaintingID = ?";
      
    $pdo = setConnectionInfo();
    $result = runQuery($pdo, $sql, Array($id));
    $pdo = null;

    $rating = $result->fetch();
    $final = round($rating[0]);
    return $final;
  }    */   
?>
