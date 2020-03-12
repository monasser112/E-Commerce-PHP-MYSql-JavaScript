<?php
session_start();
include'init.php';

?>
  <?php
  if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])){
    $getcatname=$con->prepare("select * FROM categories WHERE ID=?");
    $getcatname->Execute(array($_GET['pageid']));
    $getcatnamerow=$getcatname->fetch();
    echo "<h1 class='text-center'>". $getcatnamerow['Name']."</h1>
    <div class='container'>
      <div class='row'>";
    $itemsrowsforcat=getItmsbycat('Cat_ID',$_GET['pageid']);
    foreach ($itemsrowsforcat as $row) {
      echo '<div class="col-sm-6 col-md-3">';
        echo '<div class="thumbnail item-box">';
          echo '<span class="price-tag">$'.$row['Price'].'</span>';
          echo '<img src="img.png" alt="mizo" />';
          echo '<div  class="caption">';
            echo "<h3><a href='item.php?itemid=". $row['Item_ID']."'>" .$row['Name']."</a></h3>";
            echo '<p>'.$row['Descripition'].'<p>';
            echo '<div class="date">'.$row['Add_Date'].'</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }
  }
   ?>
  </div>
  <hr>
</div>
<?php  include $tpl .'footer.php'; ?>
