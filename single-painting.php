<?php
  include 'includes/include.inc.php';
  include 'includes/header.inc.php';
  include 'includes/ConnSetup.inc.php';

  define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
  define('DBUSER', 'testuser');
  define('DBPASS', 'mypassword');
  ?>

<main >
    <?php 
      $img = 412;
      if (isset($_GET["id"])){
        $img = $_GET["id"];
      } 
      $painting = Painting::getNewPaint($img);


      function rating($rate){
        echo '<a class="like">';
        for ($i = 0; $i < $rate; $i++) echo '<i class="orange star icon"></i>';
        echo '</a>';
      }
    ?>
    
    <!-- Main section about painting -->
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
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
              <div class="nine wide column">
                <?php 
                  echo '<img src="images/art/works/medium/'.$painting->imageFileName.'.jpg" alt="..." class="ui big image" id="artwork">';
                ?>

                <div class="ui fullscreen modal">
                  <div class="image content">
                      <?php
                        echo '<img src="images/art/works/large/'.$painting->imageFileName.'.jpg" alt="..." class="image" >';
                      ?>
                    
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                  
            </div>	           
            <div class="seven wide column">
                
                <!-- Main Info -->
                <div class="item">
          
           <?php
					echo '<h2 class="header">'.$painting->title.'</h2>
					      <h3>'.$painting->artistName.'</h3>';
          ?>

					<div class="meta">
						<p>
              <?php
                rating(Review::PaintReview($img));
              ?>
						</p>

            <?php
						  echo '<p>'.$painting->excerpt.'</p>';
            ?>
            </div>  
                </div>           
                
              
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <?php include 'includes/single-tabs.inc.php'; ?>

                
                <!-- Cart-->
                <?php include 'includes/cart.inc.php'; ?>
                            
                          
            </div>	<!-- END RIGHT data Column --> 
        </div>		<!-- END Grid --> 
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
			
            <div class="ui bottom attached active tab segment" data-tab="first">
              <?php
                echo $painting->description;
              ?>
            </div>
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
                  <tbody>
                    <tr>
                      <td>
                          Wikipedia Link
                      </td>
                      <td>
                        <?php
                          echo '<a href="'.$painting->wikiLink.'#">View painting on Wikipedia</a>';
                        ?>
                      </td>                       
                    </tr>                       
                      
                    <tr>
                      <td>
                          Google Link
                      </td>
                      <td>
                        <?php
                          echo '<a href="'.$painting->googleLink.'">View painting on Google Art Project</a>';
                        ?>
                      </td>                       
                    </tr>
                      
                    <tr>
                      <td>
                          Google Text
                      </td>
                      <td>
                        <?php
                          echo $painting->googleDescription;
                        ?>
                      </td>                       
                    </tr>                      
                  </tbody>
                </table>
            </div>  
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">
					
          <?php 
            $reviews = Review::Reviews($img);

            foreach($reviews as $review){
              echo '
              <div class="event">
              <div class="content">
                <div class="date">'.$review->date.'</div>
                <div class="meta">';

                rating($review->rating);

                echo '
                </div>                    
                <div class="summary">'
                  .$review->comment.
                '</div>       
              </div>
              </div>
              
              <div class="ui divider"></div>';
            }
          ?>                          
				</div>                                
            </div>       
        
        </div>        
    </section> 
    
    <!-- Related Images -->    
    <section class="ui container">
    <h1 class="ui dividing header">Related Works</h1>
    <div class="ui  stackable equal width grid ">
    
      <div class="row">
        <div class="ui fluid card">
          <a href="single-painting.php?id=389" class="ui medium image"><img src="images/art/works/square-medium/097050.jpg" alt=""></a>
          <div class="content">
            <h4>
              <span>Painting Title: Mona Lisa</span><br>
              <span>Artist Name: </span>
              <a href="#">Leonardo da Vinci</a>
            </h4>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="ui fluid card">
          <a href="single-painting.php?id=598" class="ui medium image"><img src="images/art/works/square-medium/141010.jpg" alt=""></a>
          <div class="content">
            <h4>
              <span>Painting Title: Saint Margaret and the Dragon</span><br>
              <span>Artist Name: </span>
              <a href="#">Agnolo Gaddi</a>
            </h4>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="ui fluid card">
          <a href="single-painting.php?id=64" class="ui medium image"><img src="images/art/works/square-medium/019060.jpg" alt=""></a>
          <div class="content">
            <h4>    
              <span>Painting Title: Self Portrait With Bandaged Ear</span><br>
              <span>Artist Name: </span>
              <a href="#">Vincent Van Gogh</a>
            </h4>
          </div>
        </div>
      </div>
    
    </div>
</section>   
	
</main>    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>