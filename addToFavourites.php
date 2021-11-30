<?php


  include 'includes/database.inc.php';
 include 'includes/include.inc.php';
  include 'includes/header.inc.php';

 
  define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
  define('DBUSER', 'testuser');
  define('DBPASS', 'mypassword');


session_start();
if ( ! empty($_GET['id']) && isset($_GET['id'])) {

  if (! isset($_SESSION['favorites'])) {
    
      $_SESSION['favorites'] = array();
  }
 
  $lstFav = $_SESSION['Favourites'];


  $img = getPaintingById($_GET["id"]);

  $lstFav[$_GET["id"]] = array($_GET["id"], $img->imageFileName, $img->title);

  $_SESSION['Favourites'] = $lstFav;


}
header("Location: view-favourites.php");


?>