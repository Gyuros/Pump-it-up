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
			data: { action: "fill-trainer-datas" },
			dataType: "json" 
		})
		.done(function(result){
	
			if(result=='error'){
				alertify.minimalDialog("Nem található ez a profil");
			}else{
				$("#title").val(result.title);
				$("#since").val(result.since);
				
				switch(result.price){
					case '1': $("#price1").prop('checked',true); 
					break;
					case '2': $("#price2").prop('checked',true); 
					break;
					case '3': $("#price3").prop('checked',true); 
					break;
				}
				
				$("#places").val(result.places);
				$("#contact").val(result.mobile);
				$("#about").val(result.introduction);
				
				if(result.type1==1){
					$("#type1").prop('checked',true);				
				}
				if(result.type2==1){
					$("#type2").prop('checked',true);				
				}
				if(result.type3==1){
					$("#type3").prop('checked',true);				
				}
				
			}
		});
	});
	
	function Save(title, since, type1, type2, type3, places, contact, about){
		$(document).ready( function(){
			
			if(type1.checked==true){
				type1=1;
			}else{
				type1=0;
			}
			
			if(type2.checked==true){
				type2=1;
			}else{
				type2=0;
			}
			
			if(type3.checked==true){
				type3=1;
			}else{
				type3=0;
			}
			
			var price = $('input[name=price]:checked').val();
				$.ajax({
					url: "ajax.php",
					type: "POST",
					data: { action: "trainer_datas", tit: title, sin: since, typ1: type1, typ2: type2, typ3: type3, pric: price, plac: places, cont: contact, ab: about }
				})
				.done(function(result){
					if(result=="success"){
						window.location="profile.php";
					}else if(result=="error"){
						alertify.minimalDialog("error");
					}
					alertify.minimalDialog(result);
				});								
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
							<li class="active"><a href="index.html">Kezdőlap</a></li>
							<li><a href="work.html">Rólunk</a></li>							
							<?php
								if($_SESSION['is_trainer']){
									echo "<li><a href='clients.php'>Klienseim</a></li>";
								}else  if(!$_SESSION['is_trainer'] && $_SESSION['is_trainer']!=''){
									echo "<li><a href='trainers.php'>Edzőm</a></li>";
								}
								
								if($_SESSION['id']!=""){
									echo "<li><a href='profile.php'>Profil</a></li>";
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
				<img src='pictures/prof-picture.png' class='img-thumbnail profile-picture'>					
			</div>
		</div>
		
		<div class='row'>
			<div class='col-sm-12'>
				<div class='personal-datas'>
					<h2 class='text-center'>Személyes adatok</h2>
					<div class='col-sm-12'><hr></div>
					<div class='row'>
						<div class='datas'>
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Képesítés</h4></div>
								<div class='col-xs-6'><input type='text' id='title'></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Mióta</h4></div>
								<div class='col-xs-6'><input type='date' id='since'></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>
								<div class='col-xs-6'><h4>Típus</h4></div>
								<div class='col-xs-6'>
									<div class='checkbox'><input type='checkbox' id='type1' value='1'>Tömegnövelő</div>
									<div class='checkbox'><input type='checkbox' id='type2' value='1'>Zsírégető</div>
									<div class='checkbox'><input type='checkbox' id='type3' value='1'>Alakformáló</div>
								</div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Értékelés</h4></div>
								<div class='col-xs-6'><span id='rating'>valami</span></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Ár</h4></div>
								<div class='col-xs-6'><div class='col-xs-4'><input name='price' type='radio' id='price1' value='1'> $</div><div class='col-xs-4'><input type='radio' name='price' id='price2' value='2'> $$</div><div class='col-xs-4'><input type='radio' name='price' id='price3' value='3'> $$$</div></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Helyek</h4></div>
								<div class='col-xs-6'><input type='text' id='places' placeholder='város1, város2, város3'></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Telefon</h4></div>
								<div class='col-xs-6'><input type='text' id='contact'></div><br><br>
							</div>
							
							<div class='col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8'>								
								<div class='col-xs-6'><h4>Bemutatkozás</h4></div>
								<div class='col-xs-12 col-sm-6'><textarea class='textarea' id='about'></textarea></div>
							</div>
							
							<div class='col-xs-12 text-center'>
								<br><br>
								<button onClick="Save(document.getElementById('title').value,document.getElementById('since').value, document.getElementById('type1'), document.getElementById('type2'), document.getElementById('type3'), document.getElementById('places').value, document.getElementById('contact').value, document.getElementById('about').value)">Adatok mentése</button>
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

