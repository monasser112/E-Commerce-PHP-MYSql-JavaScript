<?php
session_start();
if ($_SESSION['Username']) {
  $pagetitle='dashboard';
  include 'init.php';
  ?>
  <div class="body-page">



        <div class="container home-stat text-center">
            <h1 class="mb-4 pt-3">Dashboard</h1>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="state st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            <p class="mb-0">Total Members</p>
                            <span> <a href="members.php"><?php echo countItems('UserID','users'); ?></a> </span>  <!--put link to the members page-->
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="state st-pending">
                            <i class="fa fa-users"></i>
                            <div class="info">
                                <p class="mb-0">Pending Members</p>
                                <span> <a href="members.php?do=Manage&page=Pending"><?php echo checkItem("RegStatus", "users", 0) ?>
                </a> </span>  <!--put link to the members page-->
                            </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="state st-items">
                            <i class="fa fa-tag"></i>
                            <div class="info">
                                <p class="mb-0">Total Items</p>
                                <span>   <a href="items.php"><?php echo countItems('Item_ID', 'items'); ?></a> </span>  <!--put link to the members page-->
                            </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="state st-comments">
                            <i class="fa fa-comments"></i>
                            <div class="info">
                                <p class="mb-0">Total comments</p>
                                <span> <a href="comments.php"><?php echo countItems('Item_ID', 'comments'); ?></a> </span>  <!--put link to the members page-->
                            </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container latests">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card mb-3">
                        <div class="card-header header d-flex justify-content-between">
                            <i class="fa fa-users"> Latest Registered Users</i>
                            <span class="toggle-info justify-conetnt-end">
                               <button><i class="fa fa-plus fa-lg"></i></button>
                            </span>
                        </div>
                        <ul class="list-group list-group-flush latest-users">
                          <?php
                            $myrows=getlast('users','UserID',9);
                          foreach ($myrows as $row) {
                            echo "
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between dash'>
                                    <p class='m-2'>".$row['Username']."</p>
                                    <div class='d-flex justify-conetnt-end'>
                                        <span class='btn btn-success btn-dash'>
                                        <i class='fa fa-edit'></i><a class='linkforlatestuser' href='members.php?do=Edit&userid=".$row['UserID']."'>Edite</a></span>";
                                        if($row['RegStatus']==0)
                                        {
                                          echo "<span class='btn btn-primary btn-dash'>
                                              <i class='fa fa-edit'></i><a class='linkforlatestuser' href='members.php?do=Activate&userid=".$row['UserID']."'>Activate</a>
                                              </span>";
                                        }
                            echo "
                                    </div>
                                </div>
                            </li>
                            ";
                          }
                           ?>


                        </ul>
                    </div>
                </div>




                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header header d-flex justify-content-between">
                            <i class="fa fa-tag"> Latest Items</i>
                            <span class="toggle-info justify-conetnt-end">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <ul class="list-group list-group-flush latest-users">
                          <?php
                            $Itemsrows=getlast('items','Item_ID',4);
                          foreach ($Itemsrows as $row) {
                            echo "
                            <li class='list-group-item'>
                                <div class='d-flex justify-content-between dash'>
                                    <p class='m-2'>".$row['Name']."</p>
                                    <div class='d-flex justify-conetnt-end'>
                                        <span class='btn btn-success btn-dash'>
                                        <i class='fa fa-edit'></i><a class='linkforlatestuser' href='members.php?do=Edit&userid=".$row['Item_ID']."'>Edite</a></span>";
                                        if($row['Approve']==0)
                                        {
                                          echo "<span class='btn btn-primary btn-dash'>
                                              <i class='fa fa-edit'></i><a class='linkforlatestuser' href='members.php?do=Activate&userid=".$row['Item_ID']."'>Activate</a>
                                              </span>";
                                        }
                            echo "
                                    </div>
                                </div>
                            </li>
                            ";
                          }
                           ?>
                        </ul>
                    </div>
                </div>




            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card my-3">
                        <div class="card-header header d-flex justify-content-between">
                            <i class="fa fa-comments"> Latest Comments</i>
                            <span class="toggle-info justify-conetnt-end">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <ul class="list-group list-group-flush latest-users">
                          <?php
                          $commentspanel=$con->prepare("SELECT comments.*,
                            users.Username as username FROM comments
                            inner join users on users.UserID=comments.user_id");
                            $commentspanel->execute();
                            $commentspanelrows=$commentspanel->fetchALL();

                          foreach($commentspanelrows as $commentrow)
                          {
                            echo "
                            <li class='list-group-item'>
                                <div class='comment-box'>
                                  <span class='member-n'>"
                                    . $commentrow['username'].
                                    "</span><p class='member-c'>".$commentrow['comment']."</p>
                                    </div>
                                </li>";
                          }

                           ?>


                        </ul>
                    </div>
                </div>
            </div>


        </div>

    </div

  <?php
 include $tpl .'footer.php';
}
else {
  header('location:index.php');
  exite();
}
 ?>
