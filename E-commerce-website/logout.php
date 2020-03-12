<?php
session_start(); //start session_start
session_unset();
session_destroy();
header('Location:index.php');
 ?>
