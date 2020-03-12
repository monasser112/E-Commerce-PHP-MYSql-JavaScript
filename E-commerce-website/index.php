<?php
session_start();
$pagetitle="homepage";
include 'init.php';
$stmt=$con->prepare("SELECT * FROM items WHERE Approve=1 order by Item_ID desc");
$stmt->execute();
$itemsrowsforcat=$stmt->fetchALL();
?>
<h1 class="text-center">All items</h1>
<div class="container">
  <div class="row">
    <?php
    foreach ($itemsrowsforcat as $row) {
      echo '<div class="col-sm-6 col-md-3">';
        echo '<div class="thumbnail item-box">';
          echo '<span class="price-tag"> $'.$row['Price'].'</span>';
          echo '<img src="img.png" alt="mizo" />';
          echo '<div  class="caption">';
            echo "<h3><a href='item.php?itemid=". $row['Item_ID']."'>" .$row['Name']."</a></h3>";
            echo '<p>'.$row['Descripition'].'<p>';
            echo '<div class="date">'.$row['Add_Date'].'</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    }
     ?>
  </div>
</div>
<?php
 include $tpl .'footer.php';
?>
