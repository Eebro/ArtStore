<div class="ui segment">
    <div class="ui form">
        <div class="ui tiny statistic">
          <div class="value">
            <?php  echo ' $'.$painting->MSRP; ?>
          </div>
        </div>
        <div class="four fields">
            <div class="three wide field">
                <label>Quantity</label>
                <input type="number">
            </div>                               
            <div class="four wide field">
                <label>Frame</label>
                <select id="frame" class="ui search dropdown">
                <?php 
                    $frames = Frame::Frames();
                    foreach($frames as $frame){
                    echo '<option>'.$frame->title.' [ $'.$frame->price.' ]</option>';
                    }
                ?>
                </select>
            </div>  
            <div class="four wide field">
                <label>Glass</label>
                <select id="glass" class="ui search dropdown">
                <?php 
                    $glasses = Glass::Glasses();
                    foreach($glasses as $glass){
                        echo '<option>'.$glass->title.' [ $'.$glass->price.' ]</option>';
                    }
                ?>
                </select>
            </div>  
            <div class="four wide field">
                <label>Matt</label>
                <select id="matt" class="ui search dropdown">
                <?php 
                    $matts = Matt::Mattes();
                    foreach($matts as $matt){
                        echo '<option>'.$matt->title.'</option>';
                    }
                ?>
                </select>
            </div>           
        </div>                     
    </div>

    <div class="ui divider"></div>

    <button class="ui labeled icon orange button">
      <i class="add to cart icon"></i>
      Add to Cart
    </button>
      
      <?php
            echo '<a class="ui icon button" href="addToFavourites.php?id='.$img.'">
                <i class="heart icon"></i>
                Add to Favourites
            </a>';    
            ?>  
    </a>        
</div>  