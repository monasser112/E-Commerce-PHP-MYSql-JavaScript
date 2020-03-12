<?php
session_start();
include 'init.php';

if (isset($_SESSION['user'])) {
$getprofileuserdata=$con->prepare("SELECT * from users WHERE Username=?");
$getprofileuserdata->execute(array($_SESSION['user']));
$userdata=$getprofileuserdata->fetch();
//userdata have its id
?>
<h1 class="text-center">Profile</h1>
<div class="information block">
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">My Information</div>
      <div class="panel-body">
        <ul class="list-unstyled">
          					<li>
          						<i class="fa fa-unlock-alt fa-fw"></i>
          						<span>Login Name</span> : <?php echo $userdata['Username'] ?>
          					</li>
          					<li>
          						<i class="fas fa-envelope"></i>
          						<span>Email</span> : <?php echo $userdata['Email'] ?>
          					</li>
          					<li>
          						<i class="fa fa-user fa-fw"></i>
          						<span>Full Name</span> : <?php echo $userdata['FullName'] ?>
          					</li>
          					<li>
          						<i class="fa fa-calendar fa-fw"></i>
          						<span>Registered Date</span> : <?php echo $userdata['Date'] ?>
          					</li>
          					<li>
          						<i class="fa fa-tags fa-fw"></i>
          						<span>Fav Category</span> :
          					</li>
        		</ul>
            <?php
            echo "<a href='Editinfo.php?userid=".$userdata['UserID'] ."' class='btn btn-primary'>Edit Information</a>";
             ?>
      </div>
    </div>
  </div>
</div>

<div id ="my-ads"class="my-ads block">
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">My ads</div>
      <div class="panel-body">
        <?php
        $itemsrowsforuser=getItmsbycat('Member_ID',$userdata['UserID'],1);
        if (!empty($itemsrowsforuser)) {
          echo '<div class="row">';
          foreach ($itemsrowsforuser as $row) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class="price-tag"> $'.$row['Price'].'</span>';
                if ($row['Approve']==0) {
                    echo '<span class="approve-status"> Not Approved yet</span>';
                }
                echo '<img src="img.png" alt="mizo" />';
                echo '<div  class="caption">';
                    echo "<h3><a href='item.php?itemid=". $row['Item_ID']."'>" .$row['Name']."</a></h3>";
                    echo '<p>'.$row['Descripition'].'<p>';
                    echo '<div class="date">'.$row['Add_Date'].'</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
          }
            echo '</div>';
        }
        else {
          echo "sorry no ads to show";
        }

         ?>
      </div>
    </div>
  </div>
</div>

<div class="my-comments block">
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">latest comment</div>
      <div class="panel-body">
        <?php
          $usercomment=$con->prepare("SELECT comment FROM comments WHERE user_id=? LIMIT 5");
          $usercomment->execute(array($userdata['UserID']));
          $usercommentrows=$usercomment->fetchALL();
          if (!empty($usercommentrows)) {
              foreach ($usercommentrows as $row) {

                echo "<p>".$row['comment']."</p>";

              }
          }
          else {
            echo "there is no comments to show";
          }
         ?>
      </div>
    </div>
  </div>
</div>

<?php }
else {
  header('Location:login.php');
}

include $tpl .'footer.php';
  ?>
