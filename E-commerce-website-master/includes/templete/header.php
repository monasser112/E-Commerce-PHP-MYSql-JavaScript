<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php getTitle() ?></title>
    <link rel="stylesheet" href="<?php echo $css ?>bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $css ?>frontends.css">
    <script src="<?php echo $js ?>jquery-1.11.1.min.js"></script>
<script src="<?php echo $js ?>html5shiv.min.js"></script>
<script src="<?php echo $js ?>respond.min.js"></script>
<script src="<?php echo $js ?>bootstrap.min.js"></script>
<script src="<?php echo $js ?>backend.js"></script>
  <link rel="stylesheet" type="text/css" href="js/notyf.min.css"/>
  </head>
  <body>
    <div class="upper-bar">
      <div class="container">
        <?php
        if (isset($_SESSION['user'])) {
          $checkforadmin=$con->prepare("SELECT * from users where Username=? LIMIT 1 ");
          $checkforadmin->Execute(array($_SESSION['user']));
          $checkforadminrow=$checkforadmin->fetch();
         ?>


          <img src="img.png" alt="" class="img-thumbnail img-circle">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle"data-toggle="dropdown"><?php echo $_SESSION['user']; ?>
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li ><a href="profile.php">My profile</a></li>
              <li ><a href="newad.php">New item</a></li>
              <li ><a href="profile.php#my-ads"> My item</a></li>
              <?php
                if ($checkforadminrow['GroupID']==1)
                { ?>
                <li ><a href="admin/index.php"> Dashboard</a></li>
                <?php }
               ?>
              <li class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
<?php
            /*******************
            echo "Welcome ". $_SESSION['user'];
            echo '<a href="profile.php"> My profile </a>';
            echo '- <a href="newad.php"> New ad </a>';
            echo '- <a href="logout.php">Logout</a>';
            $statuscheck=checkstatusfunc($_SESSION['user']);
            if ($statuscheck==1) {
              echo "  your account need to activate";
            }**********************/
         }
         else { ?>
           <a href="login.php?do=signup" class="pull-right">signup</a>
           <span class="pull-right" style="margin:0 5px">|</span>
           <a href="login.php?do=login" class="pull-right">login</a>
         <?php  }  ?>

      </div>
    </div>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo lang('HOME_ADMIN') ?> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <?php
                $getcatrows=getcat();
                foreach ($getcatrows as $row) {
                  echo "<li><a href='categories.php?pageid=".$row['ID']."&pagename=".str_replace(' ','-',$row['Name'])."'>".$row['Name']."</a></li>";
                }
             ?>
          </ul>
        </div>
      </div>
    </nav>
