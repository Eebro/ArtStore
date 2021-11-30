<?php
  //Ibrahim Almalki - 101142978
  //SYSC 4504 Assignment 3
  // December 1, 2021

  include 'includes/include.inc.php';
  include 'includes/header.inc.php';
  include 'includes/database.inc.php';

  
  define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
  define('DBUSER', 'testuser');
  define('DBPASS', 'mypassword');


try{
  // Connecting to memcached.
  $memcache = new Memcache;
  $memcache->connect('localhost', 11211) or die ("Could not connect to the memcache server");


  // get data from memchace data, if it does not exist, store it. 
  //artists
  $artistsKey = "artists";
  $artistsCache = $memcache->get($artistsKey);
  if (!$artistsCache){
    $artistsCache = fetchArtists() or die("Failed to connect to the database");
    $memcache->set($artistsKey, $artistsCache, false, 300);
  }


  // get data from memchace data, if it does not exist, store it. 
  //shapes
  $shapesKey = "shape";
  $shapesCache = $memcache->get($shapesKey);
  if (!$shapesCache){
    $shapesCache = fetchShapes() or die("Failed to connect to the database");
    $memcache->set($shapesKey, $shapesCache, false, 300);
  }


  // get data from memchace data, if it does not exist, store it. 
  //galleries
  $galleriesKey = "gallery";
  $galleriesCache = $memcache->get($galleriesKey);
  if (!$galleriesCache){
    $galleriesCache = fetchMuseums() or die("Failed to connect to the database");
    $memcache->set($galleriesKey, $galleriesCache, false, 300);
    $galleriesCache = $memcache->get($galleriesKey);
  }



}

catch (PDOException $e) {
  die( $e->getMessage() );
}

?>
    
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
                foreach($shapesCache as $shape){
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

          // Retrives the cached data if it already exists.
          $paintingsCache = $memcache->get($paintingsKey);
            
          // If the data is not in memcache retrieve it from the database again.
          if (!$paintingsCache){
            $paintingsCache = fetchPaintings($artist, $museum, $shape) or die("Failed to connect to the database");
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