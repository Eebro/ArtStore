<?php
  session_start();
  
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_SESSION['Favourites'])) $lst = $_SESSION['Favourites'];
  
    if (isset($lst[$_GET["id"]])) unset($lst[$_GET["id"]]);
    
    $_SESSION['Favourites'] = $lst;

    header("Location: view-favourites.php");
  }
?>