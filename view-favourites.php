
<!DOCTYPE html>
<html lang=en>

<?php
include 'includes/header.inc.php';
define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
define('DBUSER', 'testuser');
define('DBPASS', 'mypassword');
?>

<head>
  <br>
  <h1 class="ui header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Favourited Paintings</h1><br>
  <ul class="ui divided items" id="paintingsList"> 

  <?php 

    $lst = $_SESSION['Favourites'];

    foreach ($lst as $favourite_img) {
      echo '<tr>';
      echo '<td><li class="item"></td>';
      echo '<td><a class="ui small image" href="single-painting.php?id='.$favourite_img[0].'">';
      echo '<td><img src="images/art/works/square-medium/'.$favourite_img[1].'.jpg"></a></td>';
      echo '<td><div class="content"></td>';
      echo '<td><br><a class="header" href="single-painting.php?id='.$favourite_img[0].'">'.$favourite_img[2].'</a></td>';
      echo '<td><div class="extra"></td>';
      echo '<td><br><a class="ui icon button" href="remove-favourites.php?id='.$favourite_img[0].'">';
      echo '<td>Remove</a></td>';
      echo '</tr>';
    }

  ?> 
  <br>
    <br>

  </ul>        
</section>  
</body>
</html> 
