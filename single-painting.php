<?php
  /**
   * Bardia Parmoun
   * 101143006
   */
  
  require_once('includes/header.inc.php');
  require_once('includes/art-config.inc.php');
  require_once('includes/database.inc.php');
  require_once('includes/classes.inc.php');
?>

<main >
    <?php 

      function drawReviewStars($rating, $fullStar, $emptyStar = ""){
        echo '<a class="like">';

        for ($i = 0; $i < $rating; $i++){
          echo $fullStar;
        }

        for ($i = $rating; $i < 5; $i++){
          echo $emptyStar;
        }
        echo '</a>';
      }

      if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (isset($_GET["id"])){
          $id = $_GET["id"];
        } else {
          $id = 441;
        }

        $painting = getPaintingById($id);
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
  

            </div>	<!-- END LEFT Picture Column -->             

			
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
                drawReviewStars(getAvgReview($id), '<i class="orange star icon"></i>', '<i class="empty star icon"></i>');
              ?>
						</p>

            <?php
						  echo '<p>'.$painting->excerpt.'</p>';
            ?>
            </div>  
                </div>                          
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
					  <tbody>
						  <tr>
						 <td>
							  Artist
						  </td>
						  <td>
                <?php
							    echo '<a href="#">'.$painting->artistName.'</a>';
                ?>
						  </td>                       
						  </tr>
						<tr>                       
						  <td>
							  Year
              <?php
							    echo '<td>'.$painting->year.'</td>';
              ?>
						</tr>       
						<tr>
						  <td>
							  Medium
						  </td>
              <?php
							    echo '<td>'.$painting->medium.'</td>';
              ?>
						</tr>  
						<tr>
						  <td>
							  Dimensions
						  </td>
              <?php
							    echo '<td>'.$painting->width.'cm x '.$painting->height.'cm </td>';
              ?>
						</tr>        
					  </tbody>
					</table>
                </div>
				
                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                      <tbody>
                        <tr>
                          <td>
                              Museum
                          </td>
                          <?php
							              echo '<td>'.$painting->galleryName.'</td>';
                          ?>
                        </tr>       
                        <tr>
                          <td>
                              Assession #
                          </td>
                          <?php
							              echo '<td>'.$painting->accessionNumber.'</td>';
                          ?>
                        </tr>  
                        <tr>
                          <td>
                              Copyright
                          </td>
                          <?php
							              echo '<td>'.$painting->copyright.'</td>';
                          ?>
                        </tr>       
                        <tr>
                          <td>
                              URL
                          </td>
                          <?php
							              echo '<td><a href="'.$painting->galleryLink.'">View painting at museum site</a></td>';
                          ?>
                        </tr>        
                      </tbody>
                    </table>    
                </div> 

                <div class="ui bottom attached tab segment" data-tab="genres">
                  <ul class="ui list">
                    <?php 
                      $genres = findPaintingGenres($id);

                      foreach($genres as $genre){
                        echo '<li class="item"><a href="'.$genre->link.'">'.$genre->genreName.'</a></li>';
                      }
                    ?>
                  </ul>
                </div>  
                
                <div class="ui bottom attached tab segment" data-tab="subjects">
                  <ul class="ui list">
                    <?php 
                      $subjects = findPaintingSubjects($id);

                      foreach($subjects as $subject){
                        echo '<li class="item"><a href="#">'.$subject->subjectName.'</a></li>';
                      }
                    ?>
                  </ul>
                </div>  
                
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
            </div>	<!-- END DescriptionTab --> 
			
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
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">
					
          <?php 
            $reviews = getReviews($id);

            foreach($reviews as $review){
              echo '
              <div class="event">
              <div class="content">
                <div class="date">'.$review->date.'</div>
                <div class="meta">';

                drawReviewStars($review->rating, '<i class="star icon"></i>');

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
    <?php include 'includes/image-list.inc.php'; ?>    
	
</main>    
    

    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>