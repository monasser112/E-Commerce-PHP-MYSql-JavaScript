<?php
/*
================================================
== Manage Members Page
== You Can Add | Edit | Delete Members From Here
================================================
*/

session_start();
if(isset($_SESSION['Username']))
{
  include 'init.php';
  $do=isset($_GET['do'])?$_GET['do']:'Manage';
  if($do=='Manage')
  {
    $query='';
    if(isset($_GET['page'])&&$_GET['page']=="Pending")
    {
      $query='AND RegStatus=0';
    }
    ?>

    <h1 class="text-center text-muted heading">Manage Members</h1>
    <div class="container">
        <div class="table-responsive table1">
            <table class="table main-table text-center table2  table-bordered">
                <tr>
                    <td>#ID</td>
                    <td>UserName</td>
                    <td>Email</td>
                    <td>Full Name</td>
                    <td>Registered Date</td>
                    <td>control</td>
                </tr>
                <tr>
            <?php
            $stmt=$con->prepare("SELECT * from users where GroupID!=1 $query");
          $stmt->execute();
          $rows=$stmt->fetchALL();
          foreach ($rows as $row) {
            echo "<tr>";
              echo "<td>". $row['UserID']. "</td>";
              echo "<td>". $row['Username']. "</td>";
              echo "<td>". $row['Email']. "</td>";
              echo "<td>". $row['FullName']. "</td>";
              echo "<td>". $row['Date']. "</td>";
                echo "<td>
                  <a href='members.php?do=Edit&userid=".$row['UserID']."' class='btn btn-table  btn-success my-1'> <i class='fa fa-edit'></i>Edite</a>
                  <a href='members.php?do=Delete&userid=".$row['UserID']."'class='btn btn-table  btn-danger my-1'> <i class='fa fa-trash-alt'></i> Delete</a>";
                  if ($row['RegStatus']==0) {
                  echo "<a href='members.php?do=Activate&userid=".$row['UserID']."' class='btn btn-table  btn-info my-1'> <i class='fa fa-edit'></i>Activate</a>";
                  }
              echo"</td>";
            echo "</tr>";
          }
           ?>
            </table>

        </div>

        <a href="members.php?do=Add" class="btn btnb btn-primary ml-auto"> <i class="fa fa-plus"></i> Add new member </a>

    </div>

  <?php }
  elseif($do=="Add"){?>
  <div class="whole-body">


    <!--start members-form-->
    <h1 class="text-center heading">Add New Member</h1>
    <div class="container ">
        <form class="form-horizontal"  action="?do=Insert" method="post" enctype="multipart/form-data">
            <!--start username-->
            <div class="form-group row justify-content-center">
                <label for="username" class="control-label col-sm-3 col-md-2"> UserName:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="text" id="usernameadd" name="username" class="form-control" placeholder="UserName">
                </div>
            </div>
            <!--end username-->

            <!--start email-->
            <div class="form-group row justify-content-center">
                <label for="email" class="control-label col-sm-3 col-md-2">Email:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="email" id="emailadd" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <!--end email-->

            <!--start password-->
            <div class="form-group row justify-content-center">
                <label for="password" class="control-label col-sm-3 col-md-2">password:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="password" id="passwordadd" name="password" class="form-control " placeholder="password">
                </div>
            </div>
            <!--end password-->

            <!--start fullname-->
            <div class="form-group row justify-content-center">
                <label for="password" class="control-label col-sm-3 col-md-2"> FullName:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="text" id="fullnameadd" name="full" class="form-control " placeholder="full name">
                </div>
            </div>
            <!--end fullname-->

            <!--start fullname-->
            <!--end fullname--

            <!--start button-->
            <div class="form-group row text-center ml-5">
                <div class="col-sm col-lg-10  col-sm-offset-2">
                    <input type="submit" id="submit-btn1add" value="Add Member" class="btn btn-outline-primary">
                </div>
            </div>
            <!--end button-->
        </form>
    </div>
  </div>
  <?php }
  elseif ($do=='Edit') {
    // Check If Get Request userid Is Numeric & Get Its Integer Value

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    // Select All Data Depend On This ID

    $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

    // Execute Query

    $stmt->execute(array($userid));

    // Fetch The Data

    $row = $stmt->fetch();

    // The Row Count

    $count = $stmt->rowCount();

    // If There's Such ID Show The Form
    if ($count > 0) { ?>

<div class="whole-body">


    <!--start members-form-->
    <h1 class="text-center heading">Edit Member</h1>
    <div class="container ">
        <form class="form-horizontal" action="?do=Update" method="post" >
            <!--start username-->
            <input type="hidden" name="userid" value="<?php echo $userid ?>" />
            <div class="form-group row justify-content-center">
                <label for="username" class="control-label col-sm-3 col-md-2"> UserName:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="text" id="username" name="username" value="<?php echo $row['Username'] ?>" class="form-control" placeholder="UserName" required="required">
                </div>
            </div>
            <!--end username-->

            <!--start email-->
            <div class="form-group row justify-content-center">
                <label for="email" class="control-label col-sm-3 col-md-2">Email:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="email" id="email"name="email" class="form-control " value="<?php echo $row['Email'] ?>"placeholder="Email" required="required">
                </div>
            </div>
            <!--end email-->

            <!--start password-->
            <div class="form-group row justify-content-center">
                <label for="password" class="control-label col-sm-3 col-md-2">password:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="hidden" name="oldpassword" class="form-control " value="<?php echo $row['Password'] ?>"placeholder="password">
                    <input id="password" type="password" name="newpassword" class="form-control " placeholder="password" >
                </div>
            </div>
            <!--end password-->

            <!--start fullname-->
            <div class="form-group row justify-content-center">
                <label for="password" class="control-label col-sm-3 col-md-2"> FullName:</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="text" id="fullname"name="full" class="form-control " value="<?php echo $row['FullName'] ?>"placeholder="Full name" >
                </div>
            </div>
            <!--end fullname-->

            <!--start button-->
            <div class="form-group row text-center ml-4">
                <div class="col-sm col-lg-10  col-sm-offset-2">
                    <input type="submit" id="submit-btn" value="Add Member" class="btn btn-outline-primary">
                </div>
            </div>
            <!--end button-->



        </form>



    </div>
</div>
  <?php }
  else {
    echo "no user with this id";
  }
}
elseif ($do=="Insert") {
  /************validat member**************/
    echo "<h1 class='text-center'>ADD Members</h1>" ;
    if ($_SERVER['REQUEST_METHOD']=='POST') {



      $user 	= $_POST['username'];
      $email 	= $_POST['email'];
      $name 	= $_POST['full'];
      $pass=$_POST['password'];
      $hashedpass=sha1($pass);
      $stmt = $con->prepare("INSERT INTO
                    users(Username, Password, Email, FullName,Date)
                  VALUES(:zuser, :zpass, :zmail, :zname,now())");
      $stmt->execute(array(
        'zuser'=>$user,
        'zpass'=>$hashedpass,
        'zmail'=>$email,
        'zname'=>$name
      ));
        echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
    }
    else {
      $errorMsg='sorry ya 3l222222222';
      redirectHome($errorMsg,6);
    }
  // code...
}
elseif ($do=="Delete") {
  echo "<h1 class='text-center'>Delete Member</h1>";
  echo "<div class='container'>";
  // Check If Get Request userid Is Numeric & Get Its Integer Value

  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

  // Select All Data Depend On This ID

  $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

  // Execute Query

  $stmt->execute(array($userid));

  // The Row Count

  $count = $stmt->rowCount();

  if($count>0)
  {
    $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");

    $stmt->bindParam(":zuser", $userid);

    $stmt->execute();

    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';
    echo $theMsg;
  }
  else {
    $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';
    echo $theMsg;

  }
  echo "</div>";
}
elseif ($do=="Activate") {

  echo "<h1 class='text-center'>Activate Member</h1>";
  echo "<div class='container'>";

    // Check If Get Request userid Is Numeric & Get The Integer Value Of It

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

    // Select All Data Depend On This ID

    $check = checkItem('userid', 'users', $userid);

    // If There's Such ID Show The Form

    if ($check > 0) {

      $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");

      $stmt->execute(array($userid));

      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

      redirectHome($theMsg);

    } else {

      $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

      redirectHome($theMsg);

    }

  echo '</div>';
}
elseif ($do=="Update") {
  echo "<h1 class='text-center'>Update Members</h1>" ;
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
    $id 	= $_POST['userid'];
    $user 	= $_POST['username'];
    $email 	= $_POST['email'];
    $name 	= $_POST['full'];
    $pass='';
    if(empty($_POST['newpassword']))
    {
      $pass=$_POST['oldpassword'];
    }
    else {
      $pass=sha1($_POST['newpassword']);
    }
    $checkusername=$con->prepare("SELECT
												*
											FROM
												users
											WHERE
												Username = ?
											AND
												UserID != ?");
    $checkusername->execute(array($user, $id));
    $count = $checkusername->rowCount();

if ($count == 1) {

  $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

  redirectHome($theMsg, 'back');

} else {


    $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
    $stmt->execute(array($user, $email, $name, $pass, $id));

    echo $stmt->rowCount().'Record updated';
  }
}
  else {
    echo "you cannot acces it directly";
  }
  // code...
}

  include $tpl .'footer.php';
}
else {
  header('Location:index.php');
}
