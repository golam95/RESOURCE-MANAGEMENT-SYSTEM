
<?php include("inc/header.php"); ?>
<?php include_once'../classes/Content.php'; ?>
<?php
	$login= Session::get("facultylogin");
	if ($login==false) {
		header("Location:login.php");
	}
?>

<?php
	$pd=new Content(); 
	if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['submit'])) {
		$ContentInsert=$pd->ContentInsert($_POST,$_FILES);
	}
?>
<section id="blog" class="section">
	<div class="container">
		<h6 style="font-size:25px;margin-left:220px;margin-bottom:40px;">Add content</h6>
		<?php 
			if (isset($ContentInsert)) {
				
				echo("<span style='color:#2769A1;margin-left:220px;font-weight:bold;'>$ContentInsert</span>");
			}
		?>
		<div class="row">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="trackname" value="<?php echo(Session::get("facultyname"));?>"/>
				<div style="margin-left:250px;margin-top:30px;" class="form-group1">
					<label for="inputUserName">Content Description</label>
					<input style="height:40px;width:700px;" class="form-control1" type="text" name="r_name" value="" placeholder="Enter description"/>
				</div> 
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Content File</label>
					<input style="height:40px;width:700px;" class="form-control1" name="image" type="file"/>
				</div> 
				<button style="margin-left:250px;margin-top:20px;" type="submit" name="submit" class="btn btn-primary">Save</button>
			</form>
			
		</div>
	</div>
</section>

<?php include("footer/foot.php"); ?>

