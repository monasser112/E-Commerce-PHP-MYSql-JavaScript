<?php
session_start();
if (isset($_SESSION['Username'])) {
  $pagetitle="Items";
  include 'init.php';
  $do=isset($_GET['do'])?$_GET['do']:'Manage';
  if ($do=="Manage") {
    $stmt=$con->prepare("select items.*,
                categories.Name as category_name,users.Username from items
                inner join categories ON categories.ID=items.Cat_ID
                inner join users ON users.UserID=items.Member_ID");
    $stmt->execute();
    $rows=$stmt->fetchALL();
    ?>
    <h1 class="text-center text-muted heading">Manage Items</h1>
    <div class="container">
     <div class="table-responsive table1 d-flex justify-content-center">
         <table class="table main-table text-center table2  table-bordered">
             <tr>
                 <td>#ID</td>
                 <td>Name</td>
                 <td>Description</td>
                 <td>Price</td>
                 <td>Adding Date</td>
                <td>Category</td>
                <td>Username</td>
                 <td>control</td>
             </tr>
               <?php
               foreach($rows as $row)
              {
                echo "<tr>";
                  echo "<td>".$row['Item_ID']."</td>";
                  echo "<td>".$row['Name']."</td>";
                  echo "<td>".$row['Descripition']."</td>";
                  echo "<td>".$row['Price']."</td>";
                  echo "<td>".$row['Add_Date']."</td>";
                  echo "<td>".$row['category_name']."</td>";
                  echo "<td>".$row['Username']."</td>";
                  echo "<td>
                    <a href='items.php?do=Edit&itemid=".$row['Item_ID']."' class='btn btn-table  btn-success my-1'><i class='fas fa-edit'></i>Edit</a>
                    <a href='items.php?do=Delete&itemid=".$row['Item_ID']."' class='btn btn-table  btn-danger my-1'><i class='fas fa-trash-alt'></i>Delete</a>";
                    if ($row['Approve']==0) {
                      echo "<a href='items.php?do=Approve&itemid=".$row['Item_ID']."' class='btn btn-table  btn-primary my-1'><i class='fas fa-user-times'></i>Approve</a>";
                    }
                  echo"</td>";
                echo "</tr>";
              }
                ?>
         </table>

     </div>

     <a href="items.php?do=Add" class="btn btnb btn-primary ml-auto"> <i class="fa fa-plus"></i> Add new item </a>

 </div>

  <?php  }
  elseif ($do=="Add") { ?>
    <div class="whole-body">

    <h1 class="text-center heading ">Add New Item</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="post">
            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Name</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <input type="text" name="name" id="item_add" class="inp form-control" placeholder="Item Name">
                </div>
            </div>

            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Description</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <input type="text" name="description" id="desc_add" class="inp form-control" placeholder="Description of the Item">
                </div>
            </div>

            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Price</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <input type="text" name="price" id="price_add" class="inp form-control" placeholder="Price of the Item">
                </div>
            </div>

            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Country</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <input type="text" name="country" id="country_add" class="inp form-control" placeholder="Country of the Item">
                </div>
            </div>

            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Status</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <select id="status_add" name="status" class="custom-select status">
                        <option selected class="option">Open this select menu</option>
                        <option value="1">...</option>
                        <option value="2">New</option>
                        <option value="3">Like New</option>
                        <option value="4">Used</option>
                        <option value="5">Very Old</option>
                    </select>
                </div>
            </div>

            <!--start members field-->
            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Member</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <select name="member" class="custom-select  member">
                        <option selected class="option">Open this select menu</option>

                        <?php
                              $stmt=$con->prepare("SELECT * FROM users");
                              $stmt->Execute();
                              $rows=$stmt->fetchALL();
                              foreach ($rows as $row) {
                                echo "<option class='option' value='" . $row['UserID'] . "'>" . $row['Username'] . "</option>";
                              }
                           ?>


                    </select>
                </div>
            </div>
             <!--End members field-->

              <!--start categories field -->
            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Category</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <select name="category" class="custom-select category">
                        <option selected class="option">Open this select menu</option>

                        <?php
                              $stmt2=$con->prepare("SELECT * FROM categories where parent=0");
                              $stmt2->Execute();
                              $rows2=$stmt2->fetchALL();
                              foreach ($rows2 as $row2) {
                                echo "<option class='option' value='" . $row2['ID'] ."'>" . $row2['Name'] ."</option>";
                                $getchildinfo=$con->prepare("SELECT * FROM categories where parent=?");
                                $getchildinfo->Execute(array($row2['ID']));
                                $getchildrows=$getchildinfo->fetchALL();
                                foreach ($getchildrows as $getchildrow) {
                                    echo "<option class='option' value='" . $getchildrow['ID'] ."'>-----" .$getchildrow['Name'] ."</option>";
                                }
                              }
                           ?>

                    </select>
                </div>
            </div>
            <!--End categories field-->

            <!--start of tags field-->
            <div class="row form-group justify-content-center">
                <label class="control-label col-sm-3 col-lg-2" for="name">Tags</label>
                <div class="col-sm-9 col-md-6 col-lg-5 type">
                    <input type="text" name="tags" id="" class="inp form-control"
                    placeholder="Tags desripe your ads">
                </div>
            </div>
            <!--end of tags field-->


            <div class="text-center">
                    <input id="submit-btn-add-item" type="submit" value="Add Item" class="btn btn-lg btn-outline-primary" >
                </div>
            </div>
        </form>
      </div>
    </div>
<?php }

  elseif ($do=="Edit") {

    $itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
    $stmt=$con->prepare("select * From items WHERE Item_ID=? LIMIT 1");
    $stmt->execute(array($itemid));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    if ($count>0) {?>
<div class="whole-body" style="height:1200px" >

  <h1 class="text-center heading">Edit Item</h1>
  <div class="container">
      <form class="form-horizontal" action="?do=Update" method="post">
          <input type="hidden" class="form-control" name="id" value="<?php echo $row['Item_ID']; ?>">
          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Name:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <input type="text" name="name" id="" class="inp form-control" value="<?php echo $row['Name'];  ?>" placeholder="Item Name">
              </div>
          </div>

          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Description:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <input type="text" name="description" id="" class="inp form-control"  value="<?php echo $row['Descripition'];  ?>"placeholder="Description of the Item">
              </div>
          </div>

          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Price:</label>
              <div class="col-sm-9  col-lg-5 type">
                  <input type="text" name="price" id="" class="inp form-control"value="<?php echo $row['Price'];  ?>" placeholder="Price of the Item">
              </div>
          </div>

          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Country:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <input type="text" name="country" id="" class="inp form-control" value="<?php echo $row['Country_Made'];  ?>"placeholder="Country of the Item">
              </div>
          </div>

          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Status:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <select name="status" class="custom-select status">
                      <option selected class="option" value="0">Open this select menu</option>
                      <option class="option" value="1"<?php if($row['Status']==1)echo "selected"; ?>>New</option>
                      <option class="option" value="2"<?php if($row['Status']==2)echo "selected"; ?>>Like New</option>
                      <option class="option" value="3"<?php if($row['Status']==3)echo "selected"; ?>>Used</option>
                      <option  class="option" value="4"<?php if($row['Status']==4)echo "selected"; ?>>Very Old</option>
                  </select>
              </div>
          </div>

          <!--start members field-->
          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Member:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <select name="member" class="custom-select  member">
                      <option selected class="option">Open this select menu</option>

                      <?php
                        $stmt2=$con->prepare("SELECT * FROM users");
                        $stmt2->Execute();
                        $rows2=$stmt2->fetchALL();
                        foreach ($rows2 as $row2) {
                          if ($row['Member_ID']==$row2['UserID']) {
                            echo "<option class='option' value='" . $row2['UserID'] . "'selected>" . $row2['Username'] . "</option>";
                          }
                          else {
                            echo "<option class='option' value='" . $row2['UserID'] . "'>" . $row2['Username'] . "</option>";
                          }
                        }
                     ?>

                  </select>
              </div>
          </div>
           <!--End members field-->

            <!--start categories field -->
          <div class="row form-group justify-content-center">
              <label class="control-label col-sm-3 col-md-2" for="name">Category:</label>
              <div class="col-sm-9 col-lg-5 type">
                  <select name="category" class="custom-select category">
                      <option selected class="option">Open this select menu</option>


                      <?php
                          $stmt3=$con->prepare("SELECT * FROM categories");
                          $stmt3->Execute();
                          $rows3=$stmt3->fetchALL();
                          foreach ($rows3 as $row3) {
                            if($row['Cat_ID']==$row3['ID'])
                            {
                              echo "<option class='option' value='" . $row3['ID'] . "'selected>" . $row3['Name'] . "</option>";
                            }
                            else {
                              echo "<option class='option' value='" . $row3['ID'] . "'>" . $row3['Name'] . "</option>";
                            }
                          }
                       ?>

                  </select>
              </div>
          </div>
           <!--End categories field-->

           <div class="row form-group justify-content-center">
               <label class="control-label col-sm-3 col-md-2" for="name">Tags:</label>
               <div class="col-sm-9 col-lg-5 type">
                   <input type="text" name="tags" id="" class="inp form-control"  value="<?php echo $row['tags'];  ?>"placeholder="Description of the Item">
               </div>
           </div>

          <div class="text-center">
                  <input type="submit" value="Edit Item" class="btn btn-lg btn-outline-primary" >
              </div>
          </div>
      </form>
      <h1 class="text-center  heading">Manage Comments</h1>
  <div class="container">
      <div class="table-responsive table1">
          <table class="table main-table text-center table2  table-bordered">
              <tr>
                  <td>Comment</td>
                  <td>User Name</td>
                  <td>Added Date</td>
                  <td>control</td>
              </tr>


              <?php
                $getcommentforitemscript=$con->prepare("SELECT comments.*,
                  users.Username as username FROM comments
                  inner join users on users.UserID=comments.user_id
                  where comments.item_id=$itemid");
                  $getcommentforitemscript->execute();
                  $rowgetcommentforitemscript=$getcommentforitemscript->fetchALL();
                foreach ($rowgetcommentforitemscript as $row) {
                  echo '<tr>';
                    echo "<td>".$row['comment'] ."</td>";
                    echo "<td>".$row['username'] ."</td>";
                    echo "<td>".$row['comment_date'] ."</td>";
                    echo "<td>
                      <a href='comments.php?do=Edit&commentid=".$row['c_id']."' class='btn btn-table  btn-success my-1'> <i class='fa fa-edit'></i>Edit</a>
                      <a href='comments.php?do=Delete&commentid=".$row['c_id']."' class='btn btn-table  btn-danger my-1'> <i class='fa fa-trash-alt'></i>Delete</a>";
                      if ($row['status']==0) {
                        echo "<a href='comments.php?do=Approve&commentid=".$row['c_id']."' class='btn btn-table  btn-primary my-1 '><i class='fas fa-user-times'></i>Approve</a>";
                      }
                    echo"</td>";
                  echo '</tr>';
                }

                 ?>
          </table>
      </div>
  </div>
</div>
    <?php }
    else {
      echo "item not found";
    }
    // code...
  }
  elseif ($do=="Update") {
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $id=$_POST['id'];
      $name=$_POST['name'];
      $desc=$_POST['description'];
      $price=$_POST['price'];
      $countery=$_POST['country'];
      $status=$_POST['status'];
      $user=$_POST['member'];
      $categories=$_POST['category'];
      $tags=$_POST['tags'];

          $formErrors = array();
            if (empty($name)) {
              $formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
            }

            if (empty($desc)) {
              $formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
            }

            if (empty($price)) {
              $formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
            }

            if (empty($countery)) {
              $formErrors[] = 'Country Can\'t be <strong>Empty</strong>';
            }

            if ($status == 0) {
              $formErrors[] = 'You Must Choose the <strong>Status</strong>';
            }
            if ($user == 0) {
              $formErrors[] = 'You Must Choose the <strong>User</strong>';
            }
            if ($categories == 0) {
              $formErrors[] = 'You Must Choose the <strong>Categories</strong>';
            }
            foreach ($formErrors as $error) {
              echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            if(Empty($formErrors))
            {
              $stmt=$con->prepare("UPDATE items SET Name=?,Descripition=?,Price=?,Country_Made=?,Status=?,Cat_ID=?,Member_ID=?,tags=? WHERE Item_ID=?");
              $stmt->execute(array($name,$desc,$price,$countery,$status,$categories,$user,$tags,$id));
            }
    }
    else {
      echo "25l3";
    }
  }
  elseif ($do=="Approve") {
    $itemid=isset($_GET['itemid'])&&is_numeric($_GET['itemid'])?intval($_GET['itemid']):0;
    $checkitem=$con->prepare("select * FROM items LIMIT 1");
    $checkitem->execute();
    $row=$checkitem->rowCount();
    if($row>0)
    {
      $stmt=$con->prepare("UPDATE items SET Approve=? WHERE Item_ID=?");
      $stmt->execute(array(1,$itemid));
    }


  }
  elseif ($do=="Delete") {
    echo "<h1 class='text-center'>Delete Member</h1>";
    echo "<div class='container'>";
    // Check If Get Request userid Is Numeric & Get Its Integer Value

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    // Select All Data Depend On This ID

    $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ? LIMIT 1");

    // Execute Query

    $stmt->execute(array($itemid));
      echo $itemid."<br/>";
    // The Row Count

    $count = $stmt->rowCount();
    echo $count."<br/>";
    if($count>0)
    {

      $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zuser");

      $stmt->bindParam(":zuser", $itemid);

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
  else if($do=="Insert")
  {
    echo'<h1 class="text-center">Insert item</h1>';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $name=$_POST['name'];
      $desc=$_POST['description'];
      $price=$_POST['price'];
      $countery=$_POST['country'];
      $status=$_POST['status'];
      $user=$_POST['member'];
      $categories=$_POST['category'];
      $tags=$_POST['tags'];
      $formErrors = array();

      if (empty($name)) {
        $formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
      }

      if (empty($desc)) {
        $formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
      }

      if (empty($price)) {
        $formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
      }

      if (empty($countery)) {
        $formErrors[] = 'Country Can\'t be <strong>Empty</strong>';
      }

      if ($status == 0) {
        $formErrors[] = 'You Must Choose the <strong>Status</strong>';
      }
      if ($user == 0) {
        $formErrors[] = 'You Must Choose the <strong>User</strong>';
      }
      if ($categories == 0) {
        $formErrors[] = 'You Must Choose the <strong>Categories</strong>';
      }
      foreach ($formErrors as $error) {
        echo '<div class="alert alert-danger">'.$error.'</div>';
      }
      if(Empty($formErrors))
      {
        $stmt=$con->prepare("INSERT INTO items (Name,Descripition,Price,Add_Date,Country_Made,Status,Cat_ID,Member_ID,tags)
        VALUES(?,?,?,now(),?,?,?,?,?)");
        $stmt->execute(array($name,$desc,$price,$countery,$status,$categories,$user,$tags));
      }
      // code...
    }
    else {
      echo "go to home page";
    }
  }
  include $tpl .'footer.php';
}
else {
  header('Location:index.php');
}
 ?>
