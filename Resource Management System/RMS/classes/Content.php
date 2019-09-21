<?php 
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once($filepath.'/../helpers/Format.php'); 
?>
<?php 
	
	class Content{
		
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db=new Database();
			$this->fm=new Format();	
		}
		public function ContentInsert($data,$file){
			// $pdata=$this->fm->validation($data);
			$ContentName=mysqli_real_escape_string($this->db->link,$data['r_name']);
			$trackname=mysqli_real_escape_string($this->db->link,$data['trackname']);
			
			$date = date('Y-m-d');
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];
			
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;
			if ($ContentName=="") {
				$msg="<span class='error'> field must not be empty</span>";
				return $msg;
				
				}elseif ($file_size >1048567) {
				echo "<span class='error'>Image Size should be less then 1MB!
				</span>";
				} elseif (in_array($file_ext, $permited) === false) {
				echo "<span class='error'>You can upload only:-"
				.implode(', ', $permited)."</span>";
				
				}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO content(contentname,content,date,trackname)
				VALUES('$ContentName','$uploaded_image','$date','$trackname')";
				
				$ContentInsert=$this->db->insert($query);
				if ($ContentInsert) {
					$msg="<span class='success'>Content add successful</span>";
					return $msg;
					}else{
					$msg="<span class='error'>Content not insert .</span>";
					return $msg;
				}
				
			}
			
		}
		
	}
	?>	