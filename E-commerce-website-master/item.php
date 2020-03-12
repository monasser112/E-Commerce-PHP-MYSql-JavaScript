<?php
session_start();
$pagetitle="Show item";
include'init.php';
$itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
$checkforitem=$con->prepare("select items.*,
            categories.Name as category_name,users.Username from items
            inner join categories ON categories.ID=items.Cat_ID
            inner join users ON users.UserID=items.Member_ID
            WHERE
								Item_ID = ? AND Approve=1");
$checkforitem->execute(array($itemid));
$item=$checkforitem->fetch();
$count=$checkforitem->rowCount();

if ($count>0) { ?>
  <h1 class="heading text-center mt-0 pt-4"><?php echo $item['Name']; ?></h1>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="img.png" class="img-responsive img-thumbnail center-block"alt="">
      </div>
      <div class="col-md-8 item-info">
  			<ul class="list-unstyled">

          <li>
            <i class="fas fa-file-signature"></i>
            <span>Name</span> : <?php echo $item['Descripition'] ?>
          </li>

          <li>
            <i class="fas fa-ad"></i>
            <span>Descripition</span> : <?php echo $item['Descripition'] ?>
          </li>

  				<li>
  					<i class="fa fa-calendar fa-fw"></i>
  					<span>Added Date</span> : <?php echo $item['Add_Date'] ?>
  				</li>
  				<li>
  					<i class="fa fa-money-bill-alt"></i>
  					<span>Price</span> : $<?php echo $item['Price'] ?>
  				</li>
  				<li>
  					<i class="fa fa-building fa-fw"></i>
  					<span>Made In</span> : <?php echo $item['Country_Made'] ?>
  				</li>
  				<li>
  					<i class="fa fa-tags fa-fw"></i>
  					<span>Category</span> : <a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name'] ?></a>
  				</li>
  				<li>
  					<i class="fa fa-user fa-fw"></i>
  					<span>Added By</span> : <a href="#"><?php echo $item['Username'] ?></a>
  				</li>
          <li>
            <i class="fas fa-tag"></i>
            <span>Tags</span> :
            <?php
            $allTags = explode(",", $item['tags']);
              foreach ($allTags as $tag) {
                $tag = str_replace(' ', '', $tag);
                if (! empty($tag)) {
                  echo "<a href='tags.php?name={$tag}'>" . $tag . '</a>  ';
                }
              }
             ?>

          </li>
  			 </ul>
      </div>
    </div>
    <hr class="mycustom">
    <?php
    if (isset($_SESSION['user'])) {  ?>
      <div class="row">
        <div class="col-md-offset-3 add-comment">
          <h3>Add your comment</h3>
          <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$_GET['itemid']; ?>" method="post">
            <textarea name="comment" required></textarea>
            <input type="submit" value="Add comment">
          </form>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $comment 	= filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                $itemid 	= $item['Item_ID'];
                $userid 	= $_SESSION['uid'];

                if (! empty($comment)) {

                  $stmt = $con->prepare("INSERT INTO
                    comments(comment, status, comment_date, item_id, user_id)
                    VALUES(:zcomment, 0, NOW(), :zitemid, :zuserid)");

                  $stmt->execute(array(

                    'zcomment' => $comment,
                    'zitemid' => $itemid,
                    'zuserid' => $userid

                  ));

                  if ($stmt) {

                    echo '<div class="alert alert-success">Comment Added</div>';

                  }

                } else {

                  echo '<div class="alert alert-danger">You Must Add Comment</div>';

                }

              }
           ?>
        </div>
      </div>
    <?php
  }
  else {
    echo '<a href="login.php?do=login">Login</a> or <a href="login.php?do=signup">Register</a> To Add Comment';
  }
     ?>
    <hr class="mycustom">
    <?php
      $getdataforitemcooment=$con->prepare("SELECT comments.* ,users.Username AS Member
                                            FROM comments
                                            inner join
                                                users
                                              on comments.user_id =users.UserID
                                            WHERE
                                                Item_ID=?
                                             AND
                                                Status=1
                                              order by
                                                  c_id desc");
        $getdataforitemcooment->execute(array($itemid));
        $rowsforcomment=$getdataforitemcooment->fetchALL();

        foreach ($rowsforcomment as $commentsrows) { ?>
          <div class="comment-box">
            <div class="row">
              <div class="col-sm-2 text-center">
                <img class="img-responsive img-thumbnail img-circle center-block" src="img.png" alt="" />
                <?php echo $commentsrows['Member'] ?>
              </div>
              <div class="col-sm-10">
                <p class="lead"><?php echo $commentsrows['comment'] ?></p>
              </div>
            </div>
            <hr class="mycustom">
          </div>
  <?php    }  ?>

    </div>
<?php }
else {
  $error="There is no such id OR item is not approved yet";
echo '<div class="alert alert-danger">' . $error . '</div>';
}

include $tpl .'footer.php';
 ?>
