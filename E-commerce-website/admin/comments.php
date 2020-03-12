<?php
session_start();
if (isset($_SESSION['Username'])) {
  $pagetitle='commentsManage';
  include 'init.php';
  $do=isset($_GET['do'])?$_GET['do']:'Mange';
  if ($do=='Mange') {
    $commentManagequery=$con->prepare("select comments.* ,
                  items.Name as ItemName,users.Username as username
                  from comments
                  inner join items ON items.Item_ID=comments.item_id
                  inner join users on users.UserID=comments.user_id");
    $commentManagequery->execute();
    $rowofcommentManagequery=$commentManagequery->fetchALL();
    if(!empty($rowofcommentManagequery))
    {  ?>

      <h1 class="text-center text-muted heading">Manage Comments</h1>
<div class="container">
    <div class="table-responsive table1">
        <table class="table main-table text-center table2  table-bordered">
            <tr>
                <td>ID</td>
                <td>Comment</td>
                <td>Item Name</td>
                <td>User Name</td>
                <td>Added Date</td>
                <td>control</td>
            </tr>
            <?php
          foreach ($rowofcommentManagequery as $row) {
            echo '<tr>';
              echo "<td>".$row['c_id'] ."</td>";
              echo "<td>".$row['comment'] ."</td>";
              echo "<td>".$row['ItemName'] ."</td>";
              echo "<td>".$row['username'] ."</td>";
              echo "<td>".$row['comment_date'] ."</td>";
              echo "<td>
                <a href='comments.php?do=Edit&commentid=".$row['c_id']."' class='btn btn-table  btn-success my-1'> <i class='fa fa-edit'></i></i>Edit</a>
                <a href='comments.php?do=Delete&commentid=".$row['c_id']."' class='btn btn-table  btn-danger my-1'> <i class='fa fa-trash-alt'></i> Delete</a>";
                if ($row['status']==0) {
                  echo "<a href='comments.php?do=Approve&commentid=".$row['c_id']."'class='btn btn-table  btn-info my-1'> <i class='fa fa-trash-alt'></i> Approve</a>";
                }
              echo"</td>";
            echo '</tr>';
          }
           ?>
        </table>
    </div>
</div>

 <?php     }
    else
    {
      echo "<div class='container'>";
        echo "<div class='alert alert-success'>no comments </div>";
        echo "<div class='btn btn-primary btn-lg'>add comments</div>";
      echo "</div>";
    }

  }
 elseif ($do=="Edit") {
   $commentid=isset($_GET['commentid'])&&is_numeric($_GET['commentid'])?intval($_GET['commentid']):0;
   $commenteditquery=$con->prepare("select * FROM comments where c_id=? LIMIT 1");
   $commenteditquery->execute(array($commentid));
   $commenteditrow=$commenteditquery->fetch();
   $count=$commenteditquery->rowCount();
   if($count>0){  ?>

<div class="whole-body">
    <!--start members-form-->
    <h1 class="text-center heading">Edit Comment</h1>
    <div class="container ">
        <form class="form-horizontal" action="?do=Update" method="post">
            <!--start comment-->
            <input type="hidden" class="form-control" name="commentid" value="<?php echo $commentid; ?>">
            <div class="form-group row justify-content-center">
                <label for="username" class="control-label col-sm-2 col-md-2"> Comment:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <textarea class="form-control" name="comment" id=""><?php echo $commenteditrow['comment'] ?></textarea>
                </div>
            </div>
            <!--end comment-->
            <!--start button-->
            <div class="form-group row text-center ml-4">
                <div class="col-sm col-lg-10  col-sm-offset-2">
                    <input type="submit" value="Save" class="btn btn-lg btn-outline-primary">
                </div>
            </div>
            <!--end button-->
        </form>
    </div>
  </div>
   <?php  }

 }
 elseif ($do=="Approve") {
   $commentid=isset($_GET['commentid'])&&is_numeric($_GET['commentid'])?intval($_GET['commentid']):0;
   $checkidforApprove=checkItem('c_id','comments',$commentid);
   if($checkidforApprove>0)
   {
     $updatcommentquery=$con->prepare("UPDATE comments set status=? where c_id=?");
     $updatcommentquery->execute(array(1,$commentid));
     echo $updatcommentquery->rowCount().'Record updated';
   }
   else {
     echo "no id for approve";
   }
 }
 elseif ($do=="Delete") {
   $commentid=isset($_GET['commentid'])&&is_numeric($_GET['commentid'])?intval($_GET['commentid']):0;
   $checkidfordelete=checkItem('c_id','comments',$commentid);
   if ($checkidfordelete>0) {
     $deletecomment=$con->prepare("DELETE From comments where c_id=?");
     $deletecomment->execute(array($commentid));
     echo "1 row deleted";
   }
 }
 elseif ($do=="Update") {
   if ($_SERVER['REQUEST_METHOD']=='POST') {
     $commentid=$_POST['commentid'];
     $commentvalue=$_POST['comment'];
     $exist=checkItem('c_id','comments',$commentid);
     if($exist>0)
     {
       $updatcommentquery=$con->prepare("UPDATE comments set `comment`=? where c_id=?");
       $updatcommentquery->execute(array($commentvalue,$commentid));
       echo $updatcommentquery->rowCount().'Record updated';
     }
     else {
       echo "no such comment id";
     }

   }
   else {
     echo "25l33333333333333";
   }
 }
  include  $tpl .'footer.php';
}
else {
  header('Location:index.php');
}
 ?>
