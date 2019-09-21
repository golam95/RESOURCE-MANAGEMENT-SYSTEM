
<?php include("inc/head.php"); ?>
<?php 
	$db=new Database();
	$fm=new Format();
?>

<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		$name=$fm->validation($_POST['name']);
		$email=$fm->validation($_POST['email']);
		$password=$fm->validation($_POST['password']);
		
		
		///
		
		$name=mysqli_real_escape_string($db->link,$name);
		$email=mysqli_real_escape_string($db->link,$email);
		$password=mysqli_real_escape_string($db->link,$password);
	    $error="";
		
		if (empty($name)||empty($email)||empty($password)) {
			
			$error="Sorry,Empty field found!!";
			
			
			}else{
			
			$query = "SELECT email FROM faculty WHERE email = '$email'";
			$checkEmail = $db->select($query);
			if($checkEmail){
				$error="Sorry email address is alredy exit!!!" ; 
				}else{
				$query = "INSERT INTO faculty(name,email,password 
				)   
				VALUES('$name','$email','$password')"; 
				$inserted_rows = $db->insert($query);    
				if ($inserted_rows) {  
					$msg="Registration is successful!!" ;  
					}else {   
					$error="Sorry,Something wrong!!" ;  
					
				}
				
			}
			
		}
	}
	
?>



<body>
	<div class="signup-form">
		<form action="" method="POST">
			<h2>Faculty Sign Up</h2>
			<p>Please fill in this form to create an account!</p>
			<hr>
			<div class="form-group">
				<?php 
					if (isset($error)) {
						
						echo("<span style='color: red;margin-left:50px;font-weight:bold;'>$error</span>");
					}
					if (isset($msg)) {
						
						echo("<span style='color: green;margin-left:50px;font-weight:bold;'>$msg</span>");
					}
				?>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" name="name" placeholder="Enter your Name" required="required">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
					<input type="email" class="form-control" name="email" placeholder="Enter your email address " required="required">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input type="password" class="form-control" name="password" placeholder="Enter your password" required="required">
				</div>
			</div>
			
			<div class="form-group">
				<label class="checkbox-inline"><input type="checkbox" name="accept" required="required"> I accept the <a href="terms.php">Terms of Use</a> &amp; <a href="terms.php">Privacy Policy</a></label>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
			</div>
		</form>
		<div class="text-center">Already have an account? <a href="login.php">Login here</a><a style="margin-left:10px;" href="index.php">Home</a></div>
	</div>
</body>
</html>                            