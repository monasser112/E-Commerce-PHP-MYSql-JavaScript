<?php
session_start();
$pagetitle="Edit";
include'init.php';
if (isset($_SESSION['user'])) {

/**********************/
if ($_SERVER['REQUEST_METHOD'] == "POST") {

				// Get Variables From The Form

				$id 	= $_POST['userid'];
				$user 	= $_POST['username'];
				$email 	= $_POST['email'];
				$name 	= $_POST['full'];

				// Password Trick

				$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

				// Validate The Form

				$formErrors = array();

				if (strlen($user) < 4) {
					$formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
				}

				if (strlen($user) > 20) {
					$formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
				}

				if (empty($user)) {
					$formErrors[] = 'Username Cant Be <strong>Empty</strong>';
				}

				if (empty($name)) {
					$formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
				}

				if (empty($email)) {
					$formErrors[] = 'Email Cant Be <strong>Empty</strong>';
				}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$stmt2 = $con->prepare("SELECT
												*
											FROM
												users
											WHERE
												Username = ?
											AND
												UserID != ?");

					$stmt2->execute(array($user, $id));

					$count = $stmt2->rowCount();

					if ($count == 1) {

						$theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

						redirectHome($theMsg, 'back');

					} else {

						// Update The Database With This Info

						$stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");

						$stmt->execute(array($user, $email, $name, $pass, $id));

						// Echo Success Message

						$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

						redirectHome($theMsg, 'back');

					}

				}

			} 

/***********************/
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

  				<h1 class="text-center">Edit Member</h1>
  				<div class="container">
  					<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
  						<!-- Start Username Field -->
  						<div class="form-group form-group-lg">
  							<label class="col-sm-2 control-label">Username</label>
  							<div class="col-sm-10 col-md-6">
  								<input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required" />
  							</div>
  						</div>
  						<!-- End Username Field -->
  						<!-- Start Password Field -->
  						<div class="form-group form-group-lg">
  							<label class="col-sm-2 control-label">Password</label>
  							<div class="col-sm-10 col-md-6">
  								<input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" />
  								<input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
  							</div>
  						</div>
  						<!-- End Password Field -->
  						<!-- Start Email Field -->
  						<div class="form-group form-group-lg">
  							<label class="col-sm-2 control-label">Email</label>
  							<div class="col-sm-10 col-md-6">
  								<input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required" />
  							</div>
  						</div>
  						<!-- End Email Field -->
  						<!-- Start Full Name Field -->
  						<div class="form-group form-group-lg">
  							<label class="col-sm-2 control-label">Full Name</label>
  							<div class="col-sm-10 col-md-6">
  								<input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" required="required" />
  							</div>
  						</div>
  						<!-- End Full Name Field -->
  						<!-- Start Submit Field -->
  						<div class="form-group form-group-lg">
  							<div class="col-sm-offset-2 col-sm-10">
  								<input type="submit" value="Save" class="btn btn-primary btn-lg" />
  							</div>
  						</div>
  						<!-- End Submit Field -->
  					</form>
  				</div>


 <?php }
}
 else {
   header('Location:Login.php');
 }
 include $tpl .'footer.php';
  ?>
