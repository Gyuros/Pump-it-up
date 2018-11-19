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
				//alertify.minimalDialog("Kérlek töltsd ki a személyes adataidat!");
			}else{
				var nodata="Nincs adat";
				if(result.name==""){
					$("#fullname").html(nodata);
				}else{
					$("#fullname").html(result.name);
				}
				
				if(result.birth_date=="0000-00-00"){
					$("#birthday").html(nodata);
				}else{
					$("#birthday").html(result.birth_date);
				}
				
				if(result.weight=="0"){
					$("#weight").html(nodata);
				}else{
					$("#weight").html(result.weight+" kg");
				}
				
				if(result.height=="0"){
					$("#height").html(nodata);
				}else{
					$("#height").html(result.height+" cm");
				}
				
				if(result.sex==""){
					$("#sex").html(nodata);
				}else{
					if(result.sex=="male"){ $("#sex").html("férfi"); }					
					if(result.sex=="female"){ $("#sex").html("nő"); }					
					if(result.sex=="other"){ $("#sex").html("egyéb"); }					
				}
			}
		});
	});
	
	
	
	$(document).ready( function() {
		$.ajax({
			url: "ajax.php",
			type: "POST",
			data: { action: "fill-trainer-datas" },
			dataType: "json" 
		})
		.done(function(result){
	
			if(result=='error'){
				alertify.minimalDialog("Nem található ez a profil");
			}else{
				var nodata="Nincs adat";
				
				if(result.title==""){
					$("#title").html(nodata);
				}else{
					$("#title").html(result.title);
				}
				
				if(result.since=="0000-00-00"){
					$("#since").html(nodata);
				}else{
					$("#since").html(result.since);
				}
				
				if(result.places==""){
					$("#places").html(nodata);
				}else{
					$("#places").html(result.places);
				}
				
				switch(result.price){
					case '1': $("#price").html("$"); 
					break;
					case '2': $("#price").html("$$"); 
					break;
					case '3': $("#price").html("$$$"); 
					break;
				}
				
				var type="<ul>";
				if(result.type1==1){
					type+="<li>Tömegnövelő</li>";			
				}
				if(result.type2==1){
					type+="<li>Zsírégető</li>";
				}
				if(result.type3==1){
					type+="<li>Alakformáló</li>";				
				}
				type+="</ul>";
				if(type=="<ul></ul>"){
					type=nodata;
				}
				$("#type").html(type);
				
				if(result.mobile==""){
					$("#contact").html(nodata);
				}else{
					$("#contact").html(result.mobile);
				}
				
				if(result.introduction==""){
					$("#about").html("<center>"+nodata+"</center>");
				}else{
					$("#about").html(result.introduction);
				}
				
				
			}
		});
	});
	
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
	
	$(document).ready( function(){
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
	});
	
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
							<li><a href="index.php">Kezdőlap</a></li>
							<li><a href="work.html">Rólunk</a></li>							
							<?php
								if($_SESSION['is_trainer']){
									echo "<li><a href='clients.php'>Klienseim</a></li>";
								}else if(!$_SESSION['is_trainer'] && $_SESSION['is_trainer']!=''){
									echo "<li><a href='trainers.php'>Edzőm</a></li>";
								}
								
								if($_SESSION['id']!=""){
									echo "<li  class='active'><a href='profile.php'>Profil</a></li>";
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
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-6'>
				<div class='personal-datas'>
					<h2 class='text-center'>Személyes adatok</h2>
					<div class='col-sm-12'><hr></div>
					<div class='row'>
						<div class='datas'>															
								<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
									<div class='col-xs-6'><h4>Teljes név</h4></div>
									<div class='col-xs-6 text-right'><span id='fullname'></span></div>
								</div>
								
								<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
									<div class='col-xs-6'><h4>Születés</h4></div>
									<div class='col-xs-6 text-right'><span id='birthday'></span></div>
								</div>
								
								<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
									<div class='col-xs-6'><h4>Nem</h4></div>
									<div class='col-xs-6 text-right'><span id='sex'></span></div>
								</div>
								
								<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
									<div class='col-xs-6'><h4>Súly</h4></div>
									<div class='col-xs-6 text-right'><span id='weight'></span></div>
								</div>
								
								<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
									<div class='col-xs-6'><h4>Magasság</h4></div>
									<div class='col-xs-6 text-right'><span id='height'></span></div>
								</div>
								
								<div class='col-xs-12 text-center'>
									<a href='edit.php'>Adatok szerkesztése</a>
								</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class='col-sm-6'>
				<div class='personal-datas' id='trainer-datas'>
				<h2 class='text-center'>Edzői adatok</h2>
					<div class='col-sm-12'><hr></div>
					<div class='row'>
						<div class='datas'>
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Képesítés</h4></div>
								<div class='col-xs-6 text-right'><span id='title'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Mióta</h4></div>
								<div class='col-xs-6 text-right'><span id='since'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Értékelés</h4></div>
								<div class='col-xs-6 text-right'><span id='rating'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Helyek</h4></div>
								<div class='col-xs-6 text-right'><span id='places'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Ár</h4></div>
								<div class='col-xs-6 text-right'><span id='price'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Edzéstípus</h4></div>
								<div class='col-xs-6 text-right'><span id='type'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Elérhetőség</h4></div>
								<div class='col-xs-6 text-right'><span id='contact'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 datas_rows'>
								<div class='col-xs-6'><h4>Bemutatkozás</h4></div>
								<div class='col-xs-12 text-right'><span id='about'>Nincs adat</span></div>
							</div>
							
							<div class='col-xs-12 text-center'>
									<a href='t_edit.php'>Adatok szerkesztése</a>
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

