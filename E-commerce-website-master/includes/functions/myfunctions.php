<?php

//my function include every thing
function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC") {

  global $con;

  $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");

  $getAll->execute();

  $all = $getAll->fetchAll();

  return $all;
  
}

function getcat()
{
  global $con;
  $getcat=$con->prepare("SELECT * from categories where parent=0");
  $getcat->execute();
  $rows=$getcat->fetchALL();
  return $rows;
}
function getItmsbycat($where,$whereID,$approval=NULL)
{
  global $con;
  if ($approval==NULL) {
    $sql='AND Approve=1';
  }
  else {
    $sql=NULL;
  }
  $getitem=$con->prepare("SELECT * from items where $where=? $sql order by Item_ID desc");
  $getitem->execute(array($whereID));
  $rows=$getitem->fetchALL();
  return $rows;
}

function checkstatusfunc($username)
{
  global $con;
  $checkforstatusofuser=$con->prepare("SELECT
                          Username,RegStatus
                          FROM users
                          WHERE Username=?
                          AND RegStatus=?");

  $checkforstatusofuser->execute(array($username,0));
  $row=$checkforstatusofuser->rowCount();
  return $row;
}


//return name of title page
function getTitle()
{
  global $pagetitle;
  if(isset($pagetitle))
  {
    echo $pagetitle;
  }
  else {
    echo "Deafult";
  }
}

function checkItem($select, $from, $value) {

  global $con;

  $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

  $statement->execute(array($value));

  $count = $statement->rowCount();

  return $count;
}







/*
** Home Redirect Function v2.0
** This Function Accept Parameters
** $theMsg = Echo The Message [ Error | Success | Warning ]
** $url = The Link You Want To Redirect To
** $seconds = Seconds Before Redirecting
*/
function redirectHome($theMsg, $url = null, $seconds = 3) {

  if ($url === null) {

    $url = 'index.php';

    $link = 'Homepage';

  } else {

    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

      $url = $_SERVER['HTTP_REFERER'];

      $link = 'Previous Page';

    } else {

      $url = 'index.php';

      $link = 'Homepage';

    }

  }

  echo $theMsg;

  echo "<div class='alert alert-info'>You Will Be Redirected to $link After $seconds Seconds.</div>";

  header("refresh:$seconds;url=$url");

  exit();

}

/*
** Count Number Of Items Function v1.0
** Function To Count Number Of Items Rows
** $item = The Item To Count
** $table = The Table To Choose From
*/

function countItems($item, $table) {

  global $con;

  $stmt2 = $con->prepare("SELECT * FROM $table");

  $stmt2->execute();

  return $stmt2->rowCount();

}

function getlast($table,$orderby,$count)
{
  global $con;
  $getstmt=$con->prepare("SELECT * from $table order by $orderby LIMIT $count");
  $getstmt->execute();
  $rows=$getstmt->fetchALL();
  return $rows;
}


 ?>
