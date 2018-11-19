<?php

	session_start();
	include "classes.php";
	$ajax = new USER;
	//error_reporting(0);

	switch ($_POST['action']) {
		case 'signup':
					$email=$_POST['email'];
					$password=$_POST['password'];
					$confirm=$_POST['confirm'];
					$isTrainer=$_POST['isTrainer'];

					echo $ajax->SignUp($email,$password,$confirm,$isTrainer);
		break;
		case 'signin':
					$email=$_POST['email'];
					$password=$_POST['password'];

					echo $ajax->SignIn($email,$password);
		break;
		case 'personal_datas': 
					$id=$_SESSION['id'];
					$name=$_POST['fullname'];
					$birth=$_POST['birthday'];
					$gender=$_POST['gender'];
					$weight=$_POST['weightt'];
					$height=$_POST['heightt'];
					
					$ajax->UpdatePersonalDatas($id,$name,$birth,$gender,$weight,$height);
		break;
		
		case 'logout': $_SESSION['id']=""; $_SESSION['is_trainer']="";
		break;
		
		case "fill-personal-datas": $datas=$ajax->PersonalDatas($_SESSION['id']); echo json_encode($datas);
		break; 
		
		case "trainer_datas": 
					$id=$_SESSION['id'];
					$title=$_POST['tit'];
					$since=$_POST['sin'];
					$price=$_POST['pric'];
					$type=array($_POST['typ1'], $_POST['typ2'], $_POST['typ3']);
					$places=$_POST['plac'];
					$contact=$_POST['cont'];
					$about=$_POST['ab'];
					
					echo $ajax->UpdateTrainerDatas($id, $title, $since, $price, $type, $places, $contact, $about);
		break;
		
		case "fill-trainer-datas": $datas=$ajax->TrainerDatas($_SESSION['id']); echo json_encode($datas);
		break;
		
		case "upload_prof_pic":
					$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
					$destinationPath = $_FILES['file']['name'];
					$id=$_SESSION['id'];
					
					echo $ajax->UploadProfilePicture($id,$sourcePath);
		break;
		
		case "load_prof_pic": echo $ajax->ProfilePicture($_SESSION['id']);
		break;

	  default:
		// code...
		break;
	}

?>
