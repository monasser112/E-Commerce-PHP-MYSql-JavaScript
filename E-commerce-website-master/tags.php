<?php
	session_start();
	include 'init.php';
?>

<div class="container">
	<div class="row">
		<?php
		if (isset($_GET['name'])) {
			$tag = $_GET['name'];
			echo "<h1 class='text-center'>" . $tag . "</h1>";
      $stmt=$con->prepare("SELECT * from items where tags like '%$tag%' AND Approve = 1");
      $stmt->execute();
      //$stmt->execute(array($tag));
      $tagItems=$stmt->fetchALL();
			foreach ($tagItems as $item) {
				echo '<div class="col-sm-6 col-md-3">';
					echo '<div class="thumbnail item-box">';
						echo '<span class="price-tag"> $' . $item['Price'] . '</span>';
						echo '<img class="img-responsive" src="img.png" alt="" />';
						echo '<div class="caption">';
							echo '<h3><a href="item.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
							echo '<p>' . $item['Descripition'] . '</p>';
							echo '<div class="date">' . $item['Add_Date'] . '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		} else {
			echo 'You Must Enter Tag Name';
		}
		?>
	</div>
</div>

<?php include $tpl . 'footer.php'; ?>
