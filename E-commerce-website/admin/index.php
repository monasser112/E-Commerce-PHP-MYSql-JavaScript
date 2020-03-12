<?php
session_start();
$noNavbar = '';
//$pagetitle='Login';
if (isset($_SESSION['Username'])) {
 header('location:dashboard.php'); // if session isnot null go to dashboard  //
  // code...
}

include 'init.php';

//Check if user gome from http request
if($_SERVER['REQUEST_METHOD']=='POST')
{
  $username = $_POST['user'];
  $password = $_POST['pass'];
  $hashedPass = sha1($password);
    //Check If User Exist In Database
    $stmt = $con->prepare("SELECT
      UserID, Username, Password
      FROM users WHERE Username = ?
      AND Password = ? AND
      GroupID = 1");
    $stmt->execute(array($username, $hashedPass));
    $row=$stmt->fetch();
    $count =  $stmt->rowCount();
    echo $count;
    if($count > 0)
    {
     $_SESSION['Username']=$username;
     $_SESSION['ID'] = $row['UserID']; // Register Session ID
     header('Location:dashboard.php');
     exite();
    }
}
 ?>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <div class="form-group">
        <h2 class="h1 text-center">Admin Login</h2>
         <input type="username" class="form-control" name="user" placeholder="Enter username">
      </div>
      <div class="form-group">
         <input type="password" class="form-control" name="pass" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>

 <?php
 include $tpl .'footer.php';
  ?>
