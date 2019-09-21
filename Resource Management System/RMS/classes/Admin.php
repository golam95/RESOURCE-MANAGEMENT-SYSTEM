<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::init();
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once($filepath.'/../helpers/Format.php'); 
?>

<?php 
	class Adminlog extends Session{
		private $db;
		private $fm;
		
		public function __construct(){
			
			$this->db=new Database();
			$this->fm=new Format();
			
		}
		public function adminLogin($email,$password){
			
			$email=$this->fm->validation($email);
			$password=$this->fm->validation($password);
			$email=mysqli_real_escape_string($this->db->link,$email);
			$password=mysqli_real_escape_string($this->db->link,($password));
			
			if (empty($email)||empty($password)) {
				$logmsg="Field must not empty!!";
				return $logmsg;
				}else{
				$query="select * from admin where email ='$email' and password ='$password'";
				$result=$this->db->select($query);
				if ($result!=false) {
					$value=$result->fetch_assoc();
					Session::set("adminlogin",true);
					Session::set("adminId",$value['id']);
					Session::set("adminusername",$value['name']);
					Session::set("adminemail",$value['email']);
					header("Location: index.php");
					}else{
					$loginmsg="Invalid username or password!";
					return $loginmsg;
					header("Location: login.php");
				}
				
			}
		}
		
		public function facultyLogin($email,$password){
			
			$email=$this->fm->validation($email);
			$password=$this->fm->validation($password);
			$email=mysqli_real_escape_string($this->db->link,$email);
			$password=mysqli_real_escape_string($this->db->link,($password));
			
			if (empty($email)||empty($password)) {
				$logmsg="Field must not empty!!";
				return $logmsg;
				}else{
				$query="select * from faculty where email ='$email' and password ='$password'";
				$result=$this->db->select($query);
				if ($result!=false) {
					$value=$result->fetch_assoc();
					Session::set("facultylogin",true);
					Session::set("facultyId",$value['id']);
					Session::set("facultyname",$value['name']);
					Session::set("facultyemail",$value['email']);
					header("Location: index.php");
					}else{
					$loginmsg="Invalid username or password!";
					return $loginmsg;
					header("Location: login.php");
				}
				
			}
		}
	
	}
?>