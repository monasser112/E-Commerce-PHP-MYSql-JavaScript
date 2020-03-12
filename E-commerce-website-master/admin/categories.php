<?php
session_start();

if(isset($_SESSION['Username']))
{
    $pagetitle='Categories';
    include'init.php';
    $do=isset($_GET['do'])?$_GET['do']:'Manage';
    if($do=="Manage")
    {
      $sort='asc';
      $myarray=array('asc','desc');
      if(isset($_GET['sort'])&&in_array($_GET['sort'],$myarray))
      {
        $sort=$_GET['sort'];
      }
      $stmt=$con->prepare("SELECT * from categories where parent=0 order by Ordering $sort");
      $stmt->execute();
      $cats=$stmt->fetchALL();
      ?>
<div class="whole-body catdif pt-2 "style="height: 1000px;" >
    <h1 class="heading text-center">Manage Categories</h1>
    <div class="container category">
        <div class="card cardd">
            <div class="d-flex justify-content-between card-header ">
                <i class="fa fa-tag header"> Manage Categories</i> <!--still not responsive when small-->
                <div class="d-flex flex-row justify-content-end ml-1 ">
                    <span class="mr-1 ord-view"> <i class="fa fa-sort"></i> <strong>Ordering</strong> :</span>
                    <a href="?sort=asc" class="hiddden mr-1"> ASC</a>
                    |
                    <a href="?sort=desc" class="ml-1 mr-2 hiddden">Desc</a>
                    <span class="mr-1 ord-view"> <i class="fa fa-eye"></i> <strong>View</strong> :</span>
                    <a href="#" class="mr-1 hiddden"> Full</a>
                    |
                    <a href="#" class="ml-1 hiddden">Classic</a>
                </div>
            </div>
            <ul class="list-group list-group-flush cats">
                <?php
                  foreach ($cats as $cat) {

                    echo "
                    <li class='list-group-item p-0'>
                        <div class='cat'>
                            <div class='hidden-buttons'>
                                <a href='categories.php?do=Edit&ID=" . $cat['ID'] . "' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>
                                <a href='categories.php?do=Delete&ID=" . $cat['ID'] . "' class='btn btn-danger'><i class='fa fa-edit'></i> Delete</a>
                            </div>
                            <div class='description'>
                                <h4 class='cat-name'>".$cat['Name']."</h4>";

                                echo "<p class='my-2'>";
                                if($cat['Description']=='')
                                  {
                                    echo "This is empty";
                                  }
                                  else {
                                    echo $cat['Description'];
                                  }
                                echo "</p>";
                                if($cat['Visibility']==1)
                                  {
                                    echo '<span class="visibility btn btn-danger " >'."hidden".'</span>';
                                  }
                                  if($cat['Allow_Comment']==1)
                                  {
                                    echo '<span class="commenting" >'."Disable".'</span>';
                                  }
                                  if($cat['Allow_Ads']==1)
                                  {
                                    echo '<span class="ads"> '. "ADVERTISE DISABLE".'</span>';
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
        <a href="categories.php?do=Add" class="btn btn-primary my-2"> <i class="fa fa-plus"></i> Add New Ctegory</a>

    </div>
  </div>
  <?php }
    elseif($do=="Add") {?>
<div class="whole-body">
      <!--start add_category form-->
    <h1 class="text-center heading">Add New Ctegory</h1>

      <div class="container">
          <form class="form-horizontal" action="?do=Insert" method="post">
              <!--satrt name-->
              <div class="row form-group justify-content-center">
                  <label for="" class="control-label col-sm-3 col-lg-2">Name</label>
                  <div class="col-sm-9 col-md-6 col-lg-5">
                      <input type="text" class="form-control" id="name_cat" name="name"
                      placeholder="Name of the category" required="required">
                  </div>
              </div>
              <!--end name-->


              <!--satrt description-->
              <div class="row form-group justify-content-center">
                  <label for="" class="control-label col-sm-3 col-lg-2">Description</label>
                  <div class="col-sm-9 col-md-6 col-lg-5">
                      <input type="text" class="form-control" id="desc_cat"name="description"
                      placeholder="Descripe the category">
                  </div>
              </div>
              <!--end description-->

              <!--satrt ordering-->
              <div class="row form-group justify-content-center">
                  <label for="" class="control-label col-sm-3 col-lg-2">Ordering</label>
                  <div class="col-sm-9 col-md-6 col-lg-5">
                      <input type="text" class="form-control" id="order_cat"name="ordering"
                      placeholder="Number of orders">
                  </div>
              </div>
              <!--end ordering-->

              <!--start category parent-->
              <div class="row form-group justify-content-center">
                  <label class="control-label col-sm-3 col-lg-2" for="name">Parent</label>
                  <div class="col-sm-9 col-md-6 col-lg-5 type">
                      <select class="custom-select status" name="parent">
                          <option value="0" selected class="option">None</option>
                          <?php
                              $stmt2=$con->prepare("SELECT * FROM categories where parent=0");
                              $stmt2->Execute();
                              $rows2=$stmt2->fetchALL();
                              foreach ($rows2 as $row2) {
                                echo "<option class='option' value='" . $row2['ID'] . "'>" . $row2['Name'] . "</option>";
                              }
                           ?>
                      </select>
                  </div>
              </div>

              <!--end category parent-->

              <!--start visibility-->
              <div class="radio-field">
                  <div class="row form-group justify-content-center">
                      <label for="" class="control-label col-sm-3 col-lg-2">Visible</label>
                      <div class="col-sm-9 col-md-6 col-lg-5">
                          <div class="form-check  rad my-2">
                              <input class="form-check-input " type="radio" name="visib"
                              id="vis-yes" value="0" checked>
                              <label class="form-check-label" for="vis-yes">
                                  Yes
                              </label>
                          </div>
                          <div class="form-check rad">
                              <input class="form-check-input" type="radio" name="visib"
                              id="vis-no" value="1">
                              <label class="form-check-label" for="vis-no">
                                  No
                              </label>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end visibility-->


              <!--start commenting-->
              <div class="radio-field">
                  <div class="row form-group justify-content-center">
                      <label for="" class="control-label col-sm-3 col-lg-2">Commenting</label>
                      <div class="col-sm-9 col-md-6 col-lg-5">
                          <div class="form-check  rad my-2">
                              <input class="form-check-input " type="radio" name="comm"
                              id="vis-yes" value="0" checked>
                              <label class="form-check-label" for="vis-yes">
                                  Yes
                              </label>
                          </div>
                          <div class="form-check rad">
                              <input class="form-check-input" type="radio" name="comm"
                              id="vis-no" value="1">
                              <label class="form-check-label" for="vis-no">
                                  Not visible
                              </label>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end commenting-->

              <!--start commenting-->
              <div class="radio-field">
                  <div class="row form-group justify-content-center">
                      <label for="" class="control-label col-sm-3 col-lg-2">Allow Ads</label>
                      <div class="col-sm-9 col-md-6 col-lg-5">
                          <div class="form-check  rad my-2">
                              <input class="form-check-input " type="radio" name="ads"
                              id="ads-yes" value="0" checked>
                              <label class="form-check-label" for="ads-yes">
                                  Yes
                              </label>
                          </div>
                          <div class="form-check rad">
                              <input class="form-check-input" type="radio" name="ads"
                              id="ads-no" value="1">
                              <label class="form-check-label" for="ads-no">
                                  No
                              </label>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end commenting-->

              <!--start button-->
              <div class="form-group row text-center ml-4 my-4">
                  <div class="col-sm col-lg-10  col-sm-offset-2">
                      <input type="submit" id="submit-btn-cat"value="Add category" class="btn btn-outline-primary">
                  </div>
              </div>
              <!--end button-->




          </form>

      </div>
    </div>
  <?php }
  elseif ($do=="Edit") {
    $userid=isset($_GET['ID'])&&is_numeric($_GET['ID'])?intval($_GET['ID']):0;
    $stmt=$con->prepare("SELECT * FROM categories WHERE ID=? LIMIT 1");
    $stmt->Execute(array($userid));
    $row=$stmt->fetch();
    $count=$stmt->rowCount();
    if($count>0){?>

      <div class="whole-body">
            <!--start add_category form-->
          <h1 class="text-center heading">Edit Category</h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="post">
                    <!--satrt name-->
                    <input type="hidden" name="catid" value="<?php echo $row['ID'] ?>">
                    <div class="row form-group justify-content-center">
                        <label for="" class="control-label col-sm-3 col-lg-2">Name</label>
                        <div class="col-sm-9 col-md-6 col-lg-5">
                            <input type="text" id="name_edit_cat" class="form-control" value="<?php echo $row['Name'] ?>" name="name"
                            required="required">
                        </div>
                    </div>
                    <!--end name-->


                    <!--satrt description-->
                    <div class="row form-group justify-content-center">
                        <label for="" class="control-label col-sm-3 col-lg-2">Description</label>
                        <div class="col-sm-9 col-md-6 col-lg-5">
                            <input type="text" id="desc_edit_cat" class="form-control" name="description"
                             value="<?php echo $row['Description'] ?>">
                        </div>
                    </div>
                    <!--end description-->

                    <!--satrt ordering-->
                    <div class="row form-group justify-content-center">
                        <label for="" class="control-label col-sm-3 col-lg-2">Ordering</label>
                        <div class="col-sm-9 col-md-6 col-lg-5">
                            <input type="text" id="order_edit_cat"class="form-control" name="ordering"
                            value="<?php echo $row['Ordering'] ?>">
                        </div>
                    </div>
                    <!--end ordering-->

                    <!--start category parent-->
                    <div class="row form-group justify-content-center">
                        <label class="control-label col-sm-3 col-lg-2" for="name">Parent</label>
                        <div class="col-sm-9 col-md-6 col-lg-5 type">
                            <select class="custom-select status" name="parent">
                                <option value="0" selected class="option">None</option>
                                <?php
                                $stmt2=$con->prepare("SELECT * FROM categories where parent=0");
                                $stmt2->Execute();
                                $rows2=$stmt2->fetchALL();
                                foreach ($rows2 as $row2) {
                                  if ($row['parent']==$row2['ID']) {
                                    echo "<option class='option' value='" . $row2['ID'] . "'selected>" . $row2['Name'] . "</option>";
                                  }
                                  echo "<option class='option' value='" . $row2['ID'] . "'>" . $row2['Name'] . "</option>";
                                }
                                 ?>
                            </select>
                        </div>
                    </div>

                    <!--end category parent-->

                    <!--start visibility-->
                    <div class="radio-field">
                        <div class="row form-group justify-content-center">
                            <label for="" class="control-label col-sm-3 col-lg-2">Visible</label>
                            <div class="col-sm-9 col-md-6 col-lg-5">
                                <div class="form-check  rad my-2">
                                    <input class="form-check-input visible_edit_cat" type="radio" name="visib"
                                    id="vis-yes" value="0" <?php if($row['Visibility']==0) {echo "checked";}?> >
                                    <label class="form-check-label" for="vis-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check rad">
                                    <input class="form-check-input visible_edit_cat" type="radio" name="visib"
                                    id="vis-no" value="1" <?php if($row['Visibility']==1) {echo "checked";}?>>
                                    <label class="form-check-label" for="vis-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end visibility-->


                    <!--start commenting-->
                    <div class="radio-field">
                        <div class="row form-group justify-content-center">
                            <label for="" class="control-label col-sm-3 col-lg-2">Commenting</label>
                            <div class="col-sm-9 col-md-6 col-lg-5">
                                <div class="form-check  rad my-2">
                                    <input class="form-check-input comment_edit_cat" type="radio" name="comm"
                                    id="vis-yes" value="0" <?php if ($row['Allow_Comment']==0)echo "checked"; ?> >
                                    <label class="form-check-label" for="vis-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check rad">
                                    <input class="form-check-input comment_edit_cat" type="radio" name="comm"
                                    id="vis-no" value="1" <?php if ($row['Allow_Comment']==1)echo "checked"; ?>>
                                    <label class="form-check-label" for="vis-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end commenting-->

                    <!--start commenting-->
                    <div class="radio-field">
                        <div class="row form-group justify-content-center">
                            <label for="" class="control-label col-sm-3 col-lg-2">Allow Ads</label>
                            <div class="col-sm-9 col-md-6 col-lg-5">
                                <div class="form-check  rad my-2">
                                    <input class="form-check-input ad_edit_cat" type="radio" name="ads"
                                    id="ads-yes" value="0" <?php if ($row['Allow_Ads']==0)echo "checked"; ?> >
                                    <label class="form-check-label" for="ads-yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check rad">
                                    <input class="form-check-input ad_edit_cat" type="radio" name="ads"
                                    id="ads-no" value="1" <?php if ($row['Allow_Comment']==1)echo "checked"; ?>>
                                    <label class="form-check-label" for="ads-no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end commenting-->

                    <!--start button-->
                    <div class="form-group row text-center ml-4 my-4">
                        <div class="col-sm col-lg-10  col-sm-offset-2">
                            <input type="submit" value="Add category" id="submit-btn-edit-cat" class="btn btn-outline-primary">
                        </div>
                    </div>
                    <!--end button-->




                </form>

            </div>
          </div>
    <?php }

  }
  elseif ($do=="Insert") {
    echo '<h1 class="text-center">ADD CATEGORT<h1/>';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $name=$_POST['name'];
      $descr=$_POST['description'];
      $parent=$_POST['parent'];
      $order=$_POST['ordering'];
      $visib=$_POST['visib'];
      $comment=$_POST['comm'];
      $ads=$_POST['ads'];


      $stmt=$con->prepare("INSERT INTO
                            categories(Name,
                            Description,parent,
                            Ordering,Visibility,
                            Allow_Comment,Allow_Ads)
                            VALUES(?,?,?,?,?,?,?)");
      $stmt->execute(array($name,$descr,$parent
      ,$order,$visib, $comment,$ads));
      // code...
    }
    else {
      echo "fokk";
      // code...
    }
    // code...
  }
  elseif ($do=="Update") {

    echo "<h1 class='text-center'>Update Members</h1>" ;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
      $id=$_POST['catid'];
      $name=$_POST['name'];
      $desc=$_POST['description'];
      $parent=$_POST['parent'];
      $Order=$_POST['ordering'];
      $visib=$_POST['visib'];
      $comm=$_POST['comm'];
      $ads=$_POST['ads'];

      $stmt=$con->prepare("UPDATE categories SET
        Name=? ,Description=?,parent=?,
        Ordering=?,Visibility=?
        ,Allow_Comment=?,
        Allow_Ads=? WHERE ID=?");
        $stmt->execute(array($name,$desc,$parent,$Order,$visib,$comm,$ads,$id));
        $theMsg= $stmt->rowCount().'Record updated';
        redirectHome($theMsg, 'back');
    }
    else {
      echo "you cannot acces this page directly";
    }

  }
  else if($do=="Delete")
  {
    echo '<h1 class="text-center">Welcom DELETE</h1>';
    echo '<div class="container">';
    $userid=isset($_GET['ID'])&&is_numeric($_GET['ID'])?intval($_GET['ID']):0;
    $stmt=$con->prepare("SELECT * FROM categories WHERE ID=? LIMIT 1");
    $stmt->Execute(array($userid));
    $count=$stmt->rowCount();
    if($count>0)
    {
      $stmt=$con->prepare("DELETE FROM categories WHERE ID=? LIMIT 1 ");
      $stmt->execute(array($userid));

      $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';
      echo $theMsg;
    }
    else {
      $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';
      echo $theMsg;
    }
        echo '</div>';
  }

    include $tpl .'footer.php';
}
else {
  echo "mizo";
}
 ?>
