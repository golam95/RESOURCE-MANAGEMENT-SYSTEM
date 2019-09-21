
<?php 
	include("inc/header.php"); 
	$db=new Database();
?>

<?php
	$login= Session::get("userlogin");
	if ($login==false) {
		header("Location:login.php");
	}
?>


<section id="blog" class="section">
	<div class="container">
		
		<!-- Three columns -->
		
		
		<form action="" method="POST">
			<div class="row">
				
				<table style="width:100%;margin-bottom:320px;" class="table table-hover">
					<thead style="background:gray;">
						<tr>
							<th style="color:white;">Name</th>
							<th style="color:white;">post</th>
							<th style="color:white;">File</th>
							<th style="color:white;">Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "SELECT * FROM content";
							$msg=$db->select($query);
							if ($msg) {
								while ($result=$msg->fetch_assoc()) {
								?>
								<tr>
									<td style="font-weight:bold;color:black;font-size:14px;"><?php echo($result['contentname']);?></td>
									<td style="font-weight:bold;color:black;font-size:14px;" ><?php echo($result['trackname']);?></td>
									
									
									<td style="font-weight:bold;color:black;font-size:14px;" >
										<a href="./Faculty/<?php echo($result['content']); ?>" download="./Faculty/<?php echo($result['content']); ?>">
											<h5 style="font-style:bold;color:red;">Download</h5>
										</a>
									</td>
									<td style="font-weight:bold;color:black;font-size:14px;" ><?php echo($result['date']);?></td>
								</tr>		
							<?php }}?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
	
</section>



<?php include("footer/foot.php"); ?>

