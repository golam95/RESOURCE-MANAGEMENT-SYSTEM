
<?php include("inc/header.php"); ?>

<?php
	$login= Session::get("adminlogin");
	if ($login==false) {
		header("Location:login.php");
	}
?>

<?php 
	
	$id = $_GET['updateid'];
	$db = new database();
	$query = "SELECT * FROM faculty WHERE id ='$id'";
	$getData = $db->select($query)->fetch_assoc();
	$date = date('Y-m-d');
	
	
	if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['bookingInfo'])) {
		
		$Name=mysqli_real_escape_string($db->link,$_POST['name']);
		$Email=mysqli_real_escape_string($db->link,$_POST['email']);
		$password=mysqli_real_escape_string($db->link,$_POST['s_password']);
		
		if ($Name==""||$Email==""||$password=="") {
			
			$error="Field must not be Empty!!!";
			
			}else{
			$query = "UPDATE faculty
			SET
			name = '$Name',
			email = '$Email',
			password = '$password'
			WHERE id = $id";
			$update = $db->update($query);
			if ($update) {  
				$msg="Update  faculty Information!!" ;  
				}else {   
				$error="Opps,Sorry Not Update!!" ;  
			} 
		}
	} 
	
?>


<section id="blog" class="section">
	<div class="container">
		<h6 style="font-size:25px;margin-left:220px;">Update Faculty Info</h6>
		<p style="font-size:15px;margin-left:220px;"><?php echo $getData['email']?></p>
		<div class="row">
			
			<form action="" method="POST">
				
				
				<div class="form-group">
					<?php 
						if (isset($error)) {
							
							echo("<span style='color: red;margin-left:250px;font-weight:bold;'>$error</span>");
						}
						if (isset($msg)) {
							
							echo("<span style='color: green;margin-left:250px;font-weight:bold;'>$msg</span>");
						}
					?>
				</div>
				
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Name</label>
					<input style="height:40px;width:700px;" class="form-control1" type="text" name="name" value="<?php echo $getData['name']?>" placeholder="Enter session name"/>
				</div> 
				
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Email</label>
					<input style="height:40px;width:700px;" class="form-control1" type="text" name="email" value="<?php echo $getData['email']?>" placeholder="Enter session description"/>
				</div> 
				
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Password</label>
					<input style="height:40px;width:700px;" class="form-control1" type="password" name="s_password" value="<?php echo $getData['password']?>" placeholder="Enter session description"/>
				</div> 
				
				<button style="margin-left:250px;" type="submit" name="bookingInfo" class="btn btn-primary">Update</button>
			</form>
			
		</div>
	</div>
</section>

<?php include("footer/foot.php"); ?>

