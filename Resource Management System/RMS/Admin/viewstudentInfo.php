
<?php include("inc/header.php"); ?>
<?php
	$login= Session::get("adminlogin");
	if ($login==false) {
		header("Location:login.php");
	}
?>

<?php 
	if (isset($_GET['delid'])) {
		$delid=$_GET['delid'];
		$delquery="delete from student where id='$delid'";
		$deldmsg=$db->delete($delquery);
	}
?>



<?php
	if (isset($_GET['updatestatus'])) {
		
		$Id=mysqli_real_escape_string($db->link,$_GET['updatestatus']);
		
		if ($Id=="") {
			
			$error="Field must not be Empty!!!";
			
			}else{
			$query = "UPDATE student
			SET
			role = 'Block'
			WHERE id = $Id";
			$update = $db->update($query);
			if ($update) {  
				$msg="Update  Information!!" ;  
				}else {   
				$error="Opps,Sorry Not Update !!" ;  
			} 
		}
	} 
	
?>


<?php
	if (isset($_GET['updatestatusun'])) {
		
		$Id=mysqli_real_escape_string($db->link,$_GET['updatestatusun']);
		
		if ($Id=="") {
			
			$error="Field must not be Empty!!!";
			
			}else{
			$query = "UPDATE student
			SET
			role = 'UNBlock'
			WHERE id = $Id";
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
		
		<p style="margin-left:90px;">Show all Student Info:</p>            
		
		<table style="width:90%;margin-left:90px;margin-bottom:320px;" class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>role</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<?php 
				$query = "SELECT * FROM student";
				$msg=$db->select($query);
				if ($msg) {
					while ($result=$msg->fetch_assoc()) {
					?>
					
					<tbody>
						<tr>
							<td><?php echo($result['name']);?></td>
							<td><?php echo($result['email']);?></td>
							<td><?php echo($result['role']);?></td>
							<td>
								
								<a style="font-weight:bold;color:red;" href="?delid=<?php echo($result['id']); ?>">Delete</a> ||
								<a style="font-weight:bold;color:green;" href="updatestudentInfo.php?updateid=<?php echo($result['id']); ?>">Update</a> ||
								
								<?php if($result['role']=="UNBlock"){ ?>
								<a style="font-weight:bold;color:green;" href="viewstudentInfo.php?updatestatus=<?php echo($result['id']); ?>">Block</a>
								<?php }else {?>
								<a style="font-weight:bold;color:green;" href="viewstudentInfo.php?updatestatusun=<?php echo($result['id']); ?>">UnBlock</a>
								<?php }?>
								
								
							</td>
						<?php }}?>
						
				</tr>
				
			</tbody>
		</table>
		
	</div>
	
	
</section>



<?php include("footer/foot.php"); ?>