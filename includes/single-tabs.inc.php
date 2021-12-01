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
        <td>Artist</td>
        <td><?php  echo '<a href="#">'.$painting->artistName.'</a>';?></td>                       
      </tr>
      <tr>                       
        <td>Year</td>
        <td><?php  echo $painting->year; ?></td>
      </tr>       
      <tr>
        <td>Medium</td>
        <td><?php echo  $painting->medium; ?></td>
      </tr>  
      <tr>
        <td>Dimensions</td>
        <td><?php echo  $painting->width.'cm x '.$painting->height.'cm'; ?></td>
      </tr>        
    </tbody>
  </table>
</div>

<div class="ui bottom attached tab segment" data-tab="museum">
    <table class="ui definition very basic collapsing celled table">
      <tbody>
        <tr>
          <td>Museum</td>
          <td>
            <?php echo $painting->galleryName; ?>
          </td>
        </tr>       
        <tr>
          <td>Accession #</td>
          <td>
            <?php echo  $painting->accessionNumber; ?>
          </td>
        </tr>  
        <tr>
          <td>Copyright</td>
          <td>
            <?php echo  $painting->copyright; ?>
          </td>
        </tr>       
        <tr>
          <td>URL</td>
          <td>
            <?php '<a href="'.$painting->galleryLink.'">View painting at museum site</a>'; ?>
          </td>
        </tr>        
      </tbody>
    </table>    
</div>   
 

<div class="ui bottom attached tab segment" data-tab="genres">
<ul class="ui list">
  <?php 
    $genres = Genre::getGenre($img);

    foreach($genres as $genre){
      echo '<li class="item"><a href="'.$genre->link.'">'.$genre->genreName.'</a></li>';
    }
  ?>
</ul>
</div>  

<div class="ui bottom attached tab segment" data-tab="subjects">
<ul class="ui list">
  <?php 
    $subjects = Subject::getSubject($img);

    foreach($subjects as $subject){
      echo '<li class="item"><a href="#">'.$subject->subjectName.'</a></li>';
    }
  ?>
</ul>
</div>  