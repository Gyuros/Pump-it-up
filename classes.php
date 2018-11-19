<?php
	class SQL{

	  private $servername = "localhost";
	  private $username = "root";
	  private $password = "";
	  private $table = "ptf";

	  protected function Conn(){

		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->table);
		$conn->query("SET NAMES utf8");
		return $conn;

	  }

	}

	class USER extends SQL{

	  function __construct(){
		// Check connection
		if ($this->Conn()->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	  }

	  public function SignUp($email,$password,$confirm,$isTrainer){
		$result=$this->Conn()->query("SELECT * FROM users WHERE email = '$email'");
		if ($result->num_rows<1) {
		  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				return "wrong_email";
		  }else if (strlen($password)>32 || strlen($password)<6) {
		  	return "wrong_pw_length";
		  }else{
				$password=md5($password);
				$sql="INSERT INTO `users`( `email`, `password`, `reg_date`, `last_login`, `is_trainer`) VALUES ('$email','$password',NOW(),NOW(),'$isTrainer')";
				$this->Conn()->query($sql);
				
				$sql="select id from users where email='$email' and password='$password'";
				$result=$this->Conn()->query($sql);
				$userId=$result->fetch_array();
				
				$sql="INSERT INTO `people`(`user_id`) VALUES ($userId[0])";
				$this->Conn()->query($sql);
				
				if($isTrainer){
					$sql="INSERT INTO `trainers`(`user_id`) VALUES ($userId[0])";
					$this->Conn()->query($sql);
				}
				
				return "success";
			}
		}else{
		  return "Exist";
			}
	  }

		public function SignIn($email,$password){
			$password=md5($password);
			$result=$this->Conn()->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
			$rows=$result->num_rows;
			if ($rows>0) {
				$row=$result->fetch_array();
				$_SESSION['id']=$row[0];
				$_SESSION['is_trainer']=$row[5];
				return "success";
			}else{
				return "wrong_login";
			}

		}
		
		public function UpdatePersonalDatas($id,$name,$birth,$sex,$weight,$height){			
			$sql="UPDATE `people` SET `name`='$name',`sex`='$sex',`birth_date`='$birth',`weight`=$weight,`height`=$height WHERE user_id=$id";
			$result=$this->Conn()->query($sql);
		}
		
		public function PersonalDatas($id){
			$sql="select name, sex, weight, height, birth_date from people where user_id=$id";
			$result=$this->Conn()->query($sql);
			if($result->num_rows>0){
				return $result->fetch_assoc();
			}else{
				return "error";
			}
		}
		
		private function TrainerID($id){
			$sql="select id from trainers where user_id=$id";
			$result=$this->Conn()->query($sql);
			$row=$result->fetch_array();
				
				return $row[0];
		}
		
		public function UpdateTrainerDatas($userId, $title, $since, $price, $type, $places, $contact, $about){			
			$sql="UPDATE `trainers` SET `title`='$title',`since`='$since',`price`='$price',`places`='$places',`mobile`='$contact',`introduction`='$about' WHERE user_id=$userId";
			$this->Conn()->query($sql);
			
			$trainerId=$this->TrainerID($userId);
			$sql="UPDATE `training_type` SET `type1`='$type[0]',`type2`='$type[1]',`type3`='$type[2]' WHERE trainer_id=$trainerId";
			$result=$this->Conn()->query($sql);
		}
		
		public function TrainerDatas($id){
			$sql="select * from trainers where user_id=$id";
			$result=$this->Conn()->query($sql);
			if($result){
				$row=$result->fetch_assoc();
				
				$trainerId=$this->TrainerID($id);
				$sql="select * from training_type where trainer_id=$trainerId";
				$result=$this->Conn()->query($sql);
				$type=$result->fetch_array();
				
				$row['type1']=$type[2];
				$row['type2']=$type[3];
				$row['type3']=$type[4];
				
				return  $row;
			}else{
				return "error";
			}
			
		}
		
		public function UploadProfilePicture($id,$sourcePath){
			if(isset($sourcePath)){
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);
				
				if (($_FILES["file"]["size"] < 10000000)//Approx. 10Mb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Hiba: " . $_FILES["file"]["error"] . "<br/><br/>";
					}else{						
						if (!file_exists("profilePictures/$id")) {
							mkdir("profilePictures/$id", 0777, true);
						}
						if (file_exists("profilePictures/$id/prof.png")) {
							unlink("profilePictures/$id/prof.png");
						}
						if (file_exists("profilePictures/$id/prof.jpg")) {
							unlink("profilePictures/$id/prof.jpg");
						}
						if (file_exists("profilePictures/$id/prof.png")) {
							unlink("profilePictures/$id/prof.jpeg");
						}
						if(move_uploaded_file($sourcePath,"profilePictures/$id/prof.$file_extension")){
							return "succes";
						}
					}
				}
			}
			
		}
		
		public function ProfilePicture($id){
			$path="profilePictures/$id/prof";
			if(file_exists("profilePictures/$id/prof.jpeg")){
				return $path.".jpeg?".date("Y-m-d H:i:s");
			}else if(file_exists("profilePictures/$id/prof.jpg")){
				return $path.".jpg?".date("Y-m-d H:i:s");
			}else if(file_exists("profilePictures/$id/prof.png")){
				return $path.".png?".date("Y-m-d H:i:s");
			}else if(file_exists("profilePictures/$id/prof.PNG")){
				return $path.".PNG?".date("Y-m-d H:i:s");
			}else{
				return 0;
			}
		}
	}

?>
