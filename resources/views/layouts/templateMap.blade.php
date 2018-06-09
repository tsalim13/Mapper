<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>S-Mapper</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Boite de communication, Mapper, Gestion" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	
<link rel="shortcut icon" type="image/x-icon" href="icone.ico"/>
<link rel="icon" type="image/x-icon" href="icone.ico"/>

<!-- bootstrap-css -->
<link rel="stylesheet" href="{{URL::to('/')}}/css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{URL::to('/')}}/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{URL::to('/')}}/css/font.css" type="text/css"/>
<link href="{{URL::to('/')}}/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{URL::to('/')}}/js/jquery-3.3.1.js"></script>
<!--<script src="{{URL::to('/')}}/js/jquery2.0.3.min.js"></script> *************************  -->
<script src="{{URL::to('/')}}/js/modernizr.js"></script>
<script src="{{URL::to('/')}}/js/jquery.cookie.js"></script>
<script src="{{URL::to('/')}}/js/screenfull.js"></script>
	  <script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
	  </script>
	  @yield('scriptMap')

</head>
<body class="dashboard-page">

	<nav class="main-menu">
		<ul>
			<li>
				<div class="full-screen">
					<section class="full-top">
						<button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>	
					</section>
				</div> <br>
			</li>
			<li>
				<a href="{!! url('/'); !!}">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">
					Dashboard
					</span>
				</a>
			</li>
			<li>
				<a href="{!! url('edit'); !!}">
					<i class="fa fa-bar-chart nav_icon"></i>
					<span class="nav-text">
						Modifier la map
					</span>
				</a>
			</li>
			<li>
				<a href="{!! url('client-edit'); !!}">
					<i class="icon-font nav-icon"></i>
					<span class="nav-text">
					Liste des clients
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
				<i class="fa fa-cogs" aria-hidden="true"></i>
				<span class="nav-text">
					Location d'emplacement
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
					<a class="subnav-text" href="{!! url('map-client'); !!}">
					Carte
					</a>
					</li>
					<li>
					<a class="subnav-text" href="grids.html">
					Formulaire
					</a>
					</li>
				</ul>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
				<i class="fa fa-check-square-o nav_icon"></i>
				<span class="nav-text">
				Forms
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="inputs.html">Inputs</a>
					</li>
					<li>
						<a class="subnav-text" href="validation.html">Form Validation</a>
					</li>
				</ul>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
					<i class="fa fa-file-text-o nav_icon"></i>
						<span class="nav-text">Pages</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="gallery.html">
							Image Gallery
						</a>
					</li>
					<li>
						<a class="subnav-text" href="calendar.html">
							Calendar
						</a>
					</li>
					<li>
						<a class="subnav-text" href="signup.html">
							Sign Up Page
						</a>
					</li>
					<li>
						<a class="subnav-text" href="login.html">
							Login Page
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="tables.html">
					<i class="icon-table nav-icon"></i>
					<span class="nav-text">
					Tables
					</span>
				</a>
			</li>
			<li>
				<a href="error.html">
					<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
					<span class="nav-text">
					Error Page
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
					<i class="fa fa-list-ul" aria-hidden="true"></i>
					<span class="nav-text">Extras</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="faq.html">FAQ</a>
					</li>
					<li>
						<a class="subnav-text" href="blank.html">Blank Page</a>
					</li>
				</ul>
			</li>
		</ul>
		<ul class="logout">
			<li>
			<a href="login.html">
			<i class="icon-off nav-icon"></i>
			<span class="nav-text">
			Logout
			</span>
			</a>
			</li>
		</ul>
	</nav>
	<section class="wrapper scrollable">
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>
		<section class="title-bar1">
			<div class="logo col-md-3">
				<b>@yield('titrePage')</b>
			</div>
			<div class="col-md-8"></div>
			<div class="col-md-3 col-md-offset-6">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				<b>@yield('indices')</b></div>
			<div class="clearfix"> </div>

		</section>

@yield('content')

@yield('modalAdd')
    		
@yield('modalSupp')
		
		<!-- footer -->
		<div class="footer">
			<img src="{{URL::to('/')}}/images/logo.png">
			
			<p>© 2018 S-Mapper . All Rights Reserved .</p>
			<p>Email : gotlm13@gmail.com . Mobile : 0698 68 35 59</p>
			
			<div class="clearfix"></div>
		</div>
		<!-- //footer -->
	</section>

	<script src="{{URL::to('/')}}/js/bootstrap.js"></script>
	<script src="{{URL::to('/')}}/js/proton.js"></script>

@yield('scriptAjax')
	
</body>
</html>