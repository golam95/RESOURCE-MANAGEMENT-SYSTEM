
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
	$query = "SELECT * FROM student WHERE id ='$id'";
	$getData = $db->select($query)->fetch_assoc();
	$date = date('Y-m-d');
	
	
	if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['customerInfo'])) {
		
		$Name=mysqli_real_escape_string($db->link,$_POST['r_name']);
		$SurName=mysqli_real_escape_string($db->link,$_POST['r_email']);
        $password=mysqli_real_escape_string($db->link,$_POST['cuspassword']);
		
		
		if ($Name==""||$SurName==""||$password=="") {
			
			$error="Field must not be Empty!!!";
			
			}else{
			$query = "UPDATE student
			SET
			name = '$Name',
			email = '$SurName',
			password ='$password'
			WHERE id = $id";
			$update = $db->update($query);
			if ($update) {  
				$msg="Update  Information!!" ;  
				}else {   
				$error="Opps,Sorry Not Update !!" ;  
			} 
		}
	} 
	
?>


<section id="blog" class="section">
	<div class="container">
		<h6 style="font-size:25px;margin-left:220px;">Update Student Info</h6>
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
					<input style="height:40px;width:700px;" class="form-control1" type="text" name="r_name" value="<?php echo $getData['name']?>" placeholder="Enter session name"/>
				</div> 
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Email</label>
					<input style="height:40px;width:700px;" class="form-control1" type="text" name="r_email" value="<?php echo $getData['email']?>" placeholder="Enter session description"/>
				</div> 
				
				<div style="margin-left:250px;" class="form-group1">
					<label for="inputUserName">Password</label>
					<input style="height:40px;width:700px;" class="form-control1" type="password" name="cuspassword" value="<?php echo $getData['password']?>" placeholder="Enter password"/>
				</div> 
				<button style="margin-left:250px;" type="submit" name="customerInfo" class="btn btn-primary">Update</button>
			</form>
			
		</div>
	</div>
</section>

<?php include("footer/foot.php"); ?>

