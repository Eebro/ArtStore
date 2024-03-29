<?php
  //Ibrahim Almalki - 101142978
  //SYSC 4504 Assignment 3
  // December 1, 2021

  include 'includes/include.inc.php';
  include 'includes/header.inc.php';
  include 'includes/ConnSetup.inc.php';

  
  define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
  define('DBUSER', 'testuser');
  define('DBPASS', 'mypassword');


try{
  // Connecting to Memcache.
  $memcache = new Memcache;
  $memcache->connect('localhost', 11211) or die ("Could not connect to the memcache server");


  // get data from memchace data, if it does not exist, store it. 
  //artists
  $memArtistsKey = "artists";
  $artistsCache = $memcache->get($memArtistsKey);
  if (!$artistsCache){
    $artistsCache = Artist::getArtists() or die("Failed to connect to the database");
    $memcache->set($memArtistsKey, $artistsCache, false, 300) or die ("Failed to save artist data at server");
  }



  // get data from memchace data, if it does not exist, store it. 
  //shapes
  $memShapesKey = "shape";
  $memcacheShapes = $memcache->get($memShapesKey);
  if (!$memcacheShapes){
    $memcacheShapes = Shape::getShape() or die("Failed to connect to the database");
    $memcache->set($memShapesKey, $memcacheShapes, false, 300) or die ("Failed to save shapes data at server");
  }




    // get data from memchace data, if it does not exist, store it. 
  //galleries
  $galleriesKey = "gallery";
  $galleriesCache = $memcache->get($galleriesKey);
  if (!$galleriesCache){
    $galleriesCache = Gallery::getGalleries() or die("Failed to connect to the database");
    $memcache->set($galleriesKey, $galleriesCache, false, 300) or die ("Failed to save gallery data at server");
    $galleriesCache = $memcache->get($galleriesKey) ;
  }
}


catch (PDOException $e) {
  die( $e->getMessage() );
}

?>

<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
	<script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">   
</head>
    
<main class="ui segment doubling stackable grid container">

    <section class="five wide column">
        <form class="ui form" method="GET">
          <h4 class="ui dividing header">Filters</h4>

          <div class="field">
            <label>Artist</label>
            <select name="artist" class="ui fluid dropdown">
              <option>Select Artist</option>  
              <?php 
                foreach($artistsCache as $artist){
                  echo '<option>'.$artist->artistName.'</option>';
                }
              ?>

            </select>
          </div>  

          <div class="field">
            <label>Museum</label>
            <select name="museum" class="ui fluid dropdown">
              <option>Select Museum</option>  
              <?php 
                foreach($galleriesCache as $gallery){
                  echo '<option>'.$gallery->galleryName.'</option>';
                }
              ?>
            </select>
          </div> 

          <div class="field">
            <label>Shape</label>
            <select name="shape" class="ui fluid dropdown">
              <option>Select Shape</option>  
              <?php 
                foreach($memcacheShapes as $shape){
                  echo '<option>'.$shape->shapeName.'</option>';
                }
              ?>
            </select>
          </div>   

          <button class="small ui orange button" type="submit">
            <i class="filter icon"></i> Filter 
          </button>    

        </form>
    </section>
    

    <section class="eleven wide column">
        <h1 class="ui header">Paintings</h1>
        <ul class="ui divided items" id="paintingsList">

        <?php 
          $paintingsKey = "empty";
          $artist = "";
          $museum = ""; 
          $shape = "";


          if ($_SERVER["REQUEST_METHOD"] == "GET"){
            if (isset($_GET["artist"]) && isset($_GET["museum"]) && isset($_GET["shape"])){
              $artist = $_GET["artist"];
              $museum = $_GET["museum"];
              $shape = $_GET["shape"];
              $paintingsKey = $_GET["artist"]."%".$_GET["museum"]."%".$_GET["shape"];
            } 
          }

          $paintingsCache = $memcache->get($paintingsKey);
            
          if (!$paintingsCache){
            $paintingsCache = Painting::getPaintings($artist, $museum, $shape) or die("Failed to connect to the database");
            $memcache->set($paintingsKey, $paintingsCache, false, 300);
          }
          
          foreach($paintingsCache as $painting){
            echo '
              <li class="item">
              <a class="ui small image" href="single-painting.php?id='.$painting->paintingID.'"><img src="images/art/works/square-medium/'.$painting->imageFileName.'.jpg"></a>
              <div class="content">
                <a class="header" href="single-painting.php?id='.$painting->paintingID.'">'.$painting->title.'</a>
                <div class="meta"><span class="cinema">'.$painting->artistName.'</span></div>        
                <div class="description">
                  <p>'.$painting->excerpt.'</p>
                </div>
                <div class="meta">     
                    <strong>$'.$painting->MSRP.'</strong>        
                </div>        
                <div class="extra">
                  <a class="ui icon orange button" href="cart.php?id='.$painting->paintingID.'"><i class="add to cart icon"></i></a>
                  <a class="ui icon button" href="addToFavourites.php?id='.$painting->paintingID.'"><i class="heart icon"></i></a>          
                </div>        
              </div>      
            </li>';
          }
        ?> 

        </ul>        
    </section>  
    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
  </footer>
</body>
</html>