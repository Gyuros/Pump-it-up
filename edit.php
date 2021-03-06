<?php

	session_start();
	error_reporting(0);
	
	if($_SESSION['id']!=""){

	}else{
		header("location: index.php");		
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Neat &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Oxygen:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<!-- Profil css --><link rel="stylesheet" type="text/css" href="CSS/profile.css">
	<!-- jQuery --><script  src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>
	<!-- Alertify -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
	$(document).ready( function(){
			alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
			return {
				main:function(content){
					this.setContent(content); 
				}
			};
		});
	});
	
	$(document).ready( function() {
		$.ajax({
			url: "ajax.php",
			type: "POST",
			data: { action: "fill-personal-datas" },
			dataType: "json"
		})
		.done(function(result){
			if(result=='error'){
				alertify.minimalDialog("Nem található ez a profil");
			}else{
				$("#fullname").val(result.name);
				$("#birthday").val(result.birth_date);
				$("#weight").val(result.weight);
				$("#height").val(result.height);
				$("#sex").val(result.sex);
			}
		});
	});
	
	function Save(name,birth,sex,weight,height){
		$(document).ready( function(){
			var Ok=true;
			
			if(name==''){
				Ok=false;
				$('#fn').html("<p class='error'>Mező kitöltése kötelező!</p>");
			}else{
				$('#fn').html(" ");
			}
			
			if(birth==''){
				Ok=false;
				$('#bd').html("<p class='error'>Mező kitöltése kötelező!</p>");
			}else{
				$('#bd').html(" ");
			}
			
			if(sex==''){
				Ok=false;
				$('#s').html("<p class='error'>Mező kitöltése kötelező!</p>");
			}else{
				$('#s').html(" ");
			}
			
			if(weight==''){
				Ok=false;
				$('#wght').html("<p class='error'>Mező kitöltése kötelező!</p>");
			}else{
				$('#wght').html(" ");
			}
			
			if(height==''){
				Ok=false;
				$('#hght').html("<p class='error'>Mező kitöltése kötelező!</p>");
			}else{
				$('#hght').html(" ");
			}

			if(Ok){
				
				$.ajax({
					url: "ajax.php",
					type: "POST",
					data: { action: "personal_datas", fullname: name, birthday: birth, gender: sex, weightt: weight, heightt: height }
				})
				.done(function(result){
					window.location="profile.php";
				});					
			}			
		});
	}
	
	function LogOut(){
		$(document).ready( function(){
			$.ajax({
				url: "ajax.php",
				type: "POST",
				data : { action: "logout" }
			})
			.done(function(result){
				window.location="index.php";
			});
		});
	}
	
	$(document).ready(function(){
 $(document).on('change', '#file', function(){
	 $('.uploadProcess').show();
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   form_data.append("action", "upload_prof_pic");
   $.ajax({
    url:"ajax.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success:function(data)
    {
		LoadProfilePicture();
    }
   });
  }
 });
});

	$(document).ready( function(){
		LoadProfilePicture();
	});
	
	function LoadProfilePicture(){
			$.ajax({
				url: "ajax.php",
				type: "POST",
				data: { action: "load_prof_pic" }
			}).done( function(result){
				if(result!='0'){
					$('#prof_pic').prop('src',result);
				}else{
					//$('prof_pic').val(result);
				}
				$('.uploadProcess').hide();
			});
		}

</script>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo">PTF</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.html">Kezdőlap</a></li>
							<li><a href="work.html">Rólunk</a></li>							
							<?php
								if($_SESSION['is_trainer']){
									echo "<li><a href='clients.php'>Klienseim</a></li>";
								}else  if(!$_SESSION['is_trainer'] && $_SESSION['is_trainer']!=''){
									echo "<li><a href='trainers.php'>Edzőm</a></li>";
								}
								
								if($_SESSION['id']!=""){
									echo "<li class='active'><a href='profile.php'>Profil</a></li>";
									echo "<li><a href=''><span onClick='LogOut()'>Kijelentkezés</span></a></li>";
								}
							?>							
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	<div class="container-wrap">
		<div class='row'>
			<div class='col-sm-12'>
				<div class='wallpaper'></div>
			</div>
		</div>	
		<div class='row'>
			<div class='col-xs-offset-2 col-xs-8 col-sm-offset-4 col-sm-4'>
				<img id='prof_pic' src='pictures/prof-picture.png' class='img-thumbnail profile-picture'>
				<!-- <form id="picUploadForm" method="post" enctype="multipart/form-data" action='ajax.php' target='uploadTarget'> -->
					<div class="image-upload col-xs-12 text-center">
						<label for="file">
							<img class="done-icon" src="pictures/upload-icon.png"/>
						</label>
						
						<input type="file" name="file" id="file" />
					</div>
					
				<!-- </form> -->
				<!-- <iframe id='uploadTarget' name='uploadTarget' src="#" style='width:0;height:0'>
				</iframe> -->
				<div class='uploadProcess'>
						Feltöltés...
				</div>
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-12'>
				<div class='personal-datas'>
					<h2 class='text-center'>Személyes adatok</h2>
					<div class='col-sm-12'><hr></div>
					<div class='row'>
						<div class='datas'>
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>								
								<div class='col-xs-6'><h4>Teljes Név</h4></div>
								<div class='col-xs-6'><input type='text' id='fullname'></div>
								<div class='col-xs-6'></div><div class='col-sm-6'><span id='fn'></span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>								
								<div class='col-xs-6'><h4>Születés</h4></div>
								<div class='col-xs-6'><input type='text' id='birthday'></div>
								<div class='col-xs-6'></div><div class='col-sm-6'><span id='bd'></span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'></div><div class='col-sm-6'><span id='s'></span></div>
								<div class='col-xs-6'><h4>Nem</h4></div>
								<div class='col-xs-6'>
									<select id='sex'>
										<option value='male'>Férfi</option>
										<option value='female'>Nő</option>
										<option value='other'>Egyéb</option>
									</select>
								</div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>								
								<div class='col-xs-6'><h4>Magasság</h4></div>
								<div class='col-xs-6'><input type='text' id='height'></div>
								<div class='col-xs-6'></div><div class='col-sm-6'><span id='hght'></span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>								
								<div class='col-xs-6'><h4>Súly</h4></div>
								<div class='col-xs-6'><input type='text' id='weight'></div>
								<div class='col-xs-6'></div><div class='col-sm-6'><span id='wght'></span></div>
							</div>
							
							<div class='col-xs-12 text-center'>
								<br><br>
								<button onClick="Save(document.getElementById('fullname').value,document.getElementById('birthday').value, document.getElementById('sex').value, document.getElementById('weight').value, document.getElementById('height').value)">Adatok mentése</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
	</div><!-- END container-wrap -->

	<div class="container-wrap">
		<footer id="fh5co-footer" role="contentinfo">
			<div class="row">
				<div class="col-md-3 fh5co-widget">
					<h4>About Neat</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
				</div>
				<div class="col-md-3 col-md-push-1">
					<h4>Latest Posts</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Amazing Templates</a></li>
						<li><a href="#">100+ Free Download Templates</a></li>
						<li><a href="#">Neat is now available</a></li>
						<li><a href="#">Download 1000+ icons</a></li>
						<li><a href="#">Big Deal for this month of March, Join Us here</a></li>
					</ul>
				</div>

				<div class="col-md-3 col-md-push-1">
					<h4>Links</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">Work</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">About us</a></li>
					</ul>
				</div>

				<div class="col-md-3">
					<h4>Contact Information</h4>
					<ul class="fh5co-footer-links">
						<li>198 West 21th Street, <br> Suite 721 New York NY 10016</li>
						<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
						<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						<li><a href="http://gettemplates.co">gettemplates.co</a></li>
					</ul>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>
		</footer>
	</div><!-- END container-wrap -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

