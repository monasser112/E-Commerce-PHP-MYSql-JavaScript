<?php

      //routes

      include 'connect.php';
      $tpl='includes/templete/';
      $css='layout/css/';
      $js='layout/js/';
      $lang='includes/languages/';
      $func='includes/functions/';
      //include important files
      include $func .'myfunctions.php';
      include $lang.'english.php';
      include $tpl .'header.php';
      
      //include navbar for script with nonavbar variable
      if(!isset($noNavbar)) {include $tpl .'navbar.php';}
?>
