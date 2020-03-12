<?php
session_start();
if (isset($_SESSION['user'])) {
  header('location:index.php');
}
$testo="mido";
include 'init.php';

$do=isset($_GET['do'])?$_GET['do']:'login';
if ($do=='login') { ?>
  <h1 class="text-center">Login Page</h1>
  <div class="container ">
    <form class="form-horizontal" action="?do=loginform" method="post">
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">Username</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="username" class="form-control "  autocomplete="off" required="required" />
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">Password</label>
        <div class="col-sm-10 col-md-4">
          <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change"required="required" />
        </div>
      </div>
      <div class="form-group form-group-lg">
        <div class="col-sm-offset-4 col-sm-10">
          <input type="submit" value="login" class="btn btn-primary " />
        </div>
      </div>
    </form>
  </div>

<?php }
elseif ($do=='signup') { ?>
  <h1 class="text-center">Signup Page</h1>
  <div class="container inputstyle ">
    <form class="form-horizontal" action="?do=signupform" method="post">
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">Username</label>
        <div class="col-sm-10 col-md-4">
          <input pattern=".{4,8}" title="user name must be bet 4 and 8" type="text" name="username" class="form-control" autocomplete="off" required="required" />
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">Password</label>
        <div class="col-sm-10 col-md-4">
          <input minlength="4" type="password" name="password" class="form-control" autocomplete="new-password" placeholder="enter tour password" required="required" />
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">verify-Password</label>
        <div class="col-sm-10 col-md-4">
          <input type="password" name="vpassword" class="form-control" autocomplete="new-password" placeholder="verify your password" required="required" />
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-2 col-md-offset-2 control-label">Email</label>
        <div class="col-sm-10 col-md-4">
          <input type="email" name="email" class="form-control" placeholder="Enter your email" required="required" />
        </div>
      </div>
      <div class="form-group form-group-lg">
        <div class="col-sm-offset-5 col-sm-10">
          <input type="submit" value="Signup" class="btn btn-primary " />
        </div>
      </div>
    </form>
  </div>

<?php }
elseif ($do=="loginform") {
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $hashpass=sha1($password);
    $checkloginuser=$con->prepare("SELECT * FROM
                                  users WHERE Username=?
                                  AND Password=? LIMIT 1");
    $checkloginuser->execute(array($username,$hashpass));
    $dataofloginuser=$checkloginuser->fetch();
    $checkifexict=$checkloginuser->rowCount();
    echo "mido";
    if($checkifexict>0)
    {
      $_SESSION['user']=$username;
      $_SESSION['uid']=$dataofloginuser['UserID'];
      header('location:index.php');
      exite();
    }
}
}
else if($do=="signupform")
{
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $passwordverify=$_POST['vpassword'];
    $email=$_POST['email'];

    $formerror=array();
/**********************username validate*******************/
    if (isset($_POST['username'])) {
      $filtereduser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);

      $checkifusernameexist=$con->prepare("SELECT * FROM users
                                            WHERE Username=?");
      $checkifusernameexist->execute(array($filtereduser)) ;
      $rowofusernameexist= $checkifusernameexist->rowCount();
      if ($rowofusernameexist==0) {
        if (strlen($filtereduser) < 4) {
          $formerror[]='user name must be larger than 4'.'<br>';
        }
      }
      else {
        $formerror[]='username excit'.'<br>';
      }
    }
    /**********************end username validate*******************/

    /********************password validate*************/
    if (isset($_POST['password'])&&isset($_POST['vpassword'])) {
      if (strlen($_POST['password'])>=6) {
        $pass1=sha1($_POST['password']);
        $pass2=sha1($_POST['vpassword']);
        if ($pass1!==$pass2) {
          $formerror[]='not equal password'.'<br>';
        }
      }
      else {
            $formerror[]='passqord length isnot valid'.'<br>';
      }

    }

    /********************end password validate***********/
    /**********************start email validate*******************/
        if (isset($_POST['email'])) {
          $filteredemail=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

          if (filter_var($filteredemail,FILTER_VALIDATE_EMAIL)!=true) {
            $formerror[]='invalid email';
          }

        }
        /**********************end email validate*******************/
        /*********************start check for user name Exist and insert************/
        if (empty($formerror)) {
          $checkifusernameexist=checkItem('Username','users',$username);
          if ($checkifusernameexist==0) {
            $inseruserquery=$con->prepare("INSERT INTO users (Username,Password,Email,RegStatus,Date)
                                          VALUES(?,?,?,?,now())");
            $inseruserquery->Execute(array($username,sha1($password),$email,0));

            echo "Congratualte you are registered";
          }
        }
        /*********************end user name exist******************/
    foreach ($formerror as $error) {
      echo $error;
      // code...
    }
}
}

include $tpl .'footer.php';

?>
