
<?php include("inc/header.php"); ?>
<?php
		$login= Session::get("adminlogin");
		if ($login==false) {
		   header("Location:login.php");
		}
     ?>
<section id="blog" class="section">
	
	<div class="container">
		
		            
		
		<table style="width:90%;margin-left:90px;margin-bottom:320px;" class="table table-hover">
			<thead>
				<tr>
					<th></th>
					<th></th>
					
				</tr>
			</thead>
			
			
			<tbody>
				<tr>
					<td></td>
					<td><h3>Welcome admin dashboard</h3></td>
				</tr>
			

				
				
			</tbody>
		</table>
		
	</div>
	
	
</section>



<?php include("footer/foot.php"); ?>