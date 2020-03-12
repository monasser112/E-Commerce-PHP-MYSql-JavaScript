<?php
session_start();
$pagetitle='NEW ADD';
include'init.php';
if (isset($_SESSION['user'])) {
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $formerror=array();
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $desc=filter_var($_POST['descrp'],FILTER_SANITIZE_STRING);
    $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
    $country=filter_var($_POST['countery'],FILTER_SANITIZE_STRING);
    $status=filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
    $category=filter_var($_POST['categories'],FILTER_SANITIZE_STRING);
    $tags=filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
    if (strlen($name) < 4) {

				$formErrors[] = 'Item Title Must Be At Least 4 Characters';

			}

			if (strlen($desc) < 10) {

				$formErrors[] = 'Item Description Must Be At Least 10 Characters';

			}

			if (strlen($country) < 2) {

				$formErrors[] = 'Item Title Must Be At Least 2 Characters';

			}

			if (empty($price)) {

				$formErrors[] = 'Item Price Cant Be Empty';

			}

			if (empty($status)) {

				$formErrors[] = 'Item Status Cant Be Empty';

			}

			if (empty($category)) {

				$formErrors[] = 'Item Category Cant Be Empty';

			}

      if (empty($formErrors)) {

  // Insert Userinfo In Database

  $stmt = $con->prepare("INSERT INTO

    items(Name, Descripition, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID,tags)

    VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember,:ztags)");

  $stmt->execute(array(

    'zname' 	=> $name,
    'zdesc' 	=> $desc,
    'zprice' 	=> $price,
    'zcountry' 	=> $country,
    'zstatus' 	=> $status,
    'zcat'		=> $category,
    'zmember'	=> $_SESSION['uid'],
    'ztags'=> $tags

  ));

  // Echo Success Message

  if ($stmt) {
    $succesMsg = 'Item Has Been Added';

  }
}
}
?>
<h1 class="text-center">NEW AD</h1>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Creat new ad</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="form-group form-group-lg ">
                <label class="control-label col-sm-2">Name</label>
                <div class="col-sm-10 col-md-9 ">
                  <input type="text" class="form-control" name="name" placeholder="Enter email" >
                </div>
              </div>
              <div class="form-group form-group-lg ">
                <label class="control-label col-sm-2">Description</label>
                <div class="col-sm-10 col-md-9 ">
                  <input type="text" class="form-control" name="descrp"placeholder="Describe your item">
                </div>
              </div>

              <div class="form-group form-group-lg ">
                <label class="control-label col-sm-2">Price</label>
                <div class="col-md-9 col-sm-10">
                  <input type="text" class="form-control"name="price" placeholder="Enter price">
                </div>
              </div>

              <div class="form-group form-group-lg ">
                  <label class="control-label col-sm-2">Countery</label>
                <div class="col-md-9 col-sm-10">
                  <input type="text" class="form-control" name="countery"placeholder="Enter Counter made">
                </div>
              </div>

              <div class="form-group form-group-lg ">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10 col-md-9">
                  <select class="form-control"name="status">
                    <option value="">...</option>
                    <option value="1">New</option>
                    <option value="2">Like New</option>
                    <option value="3">Used</option>
                    <option value="4">Very Old</option>
                  </select>
                </div>
              </div>

              <div class="form-group form-group-lg ">
                <label class="col-sm-2 control-label">Categories</label>
                <div class="col-sm-10 col-md-9">
                  <select class="form-control"name="categories">
                    <option value="">...</option>
                    <?php
                        $stmt2=$con->prepare("SELECT * FROM categories where parent=0");
                        $stmt2->Execute();
                        $rows2=$stmt2->fetchALL();
                        foreach ($rows2 as $row2) {
                          echo "<option value='" . $row2['ID'] . "'>" . $row2['Name'] . "</option>";
                        }
                     ?>
                  </select>
                </div>
              </div>

              <div class="form-group form-group-lg ">
                  <label class="control-label col-sm-2">Tags</label>
                <div class="col-md-9 col-sm-10">
                  <input type="text" class="form-control" name="tags" placeholder="Seperat tags by gomma">
                </div>
              </div>

              <div class="form-group form-group-lg ">
                <div class="col-sm-offset-2  col-sm-10">
                  <input type="submit" class="btn btn-primary btn-lg" value="save">
                </div>
              </div>
            </form>
        </div>

        <div class="col-md-4">
          <div class="col-sm-10 col-md-12">
            <div class="thumbnail item-box">
              <span class="price-tag">eshta</span>
              <img src="img.png" alt="mizo"/>
              <div  class="caption">
                 <h3>hamo</h3>
                  <p>mido<p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      if (! empty($formErrors)) {
        foreach ($formErrors as $error) {
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }
      }
      if (isset($succesMsg)) {
        echo '<div class="alert alert-success">' . $succesMsg . '</div>';
      }


       ?>
    </div>
  </div>
</div>


<?php }
else {
  header('Location:Login.php');
}
include $tpl .'footer.php';
 ?>
