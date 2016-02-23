<!DOCTYPE HTML>

<html>
	<head>
		<title>Know yourself</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		
		{{HTML::script('js/skel.min.js')}}
		{{HTML::script('js/skel-panels.min.js')}}
		{{HTML::script('js/init.js')}}
	

		{{HTML::style('css/skel-noscript.css')}}
		{{HTML::style('css/style.css')}}
		{{HTML::style('css/style-desktop.css')}}


	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="{{URL::to('posts')}}">All</a></li>

						@foreach(Category::all() as $category)
						<li><a href="{{URL::to('categories/' .$category->id)}}">{{$category->name}}</a></li>
						@endforeach

						@if(Auth::check())
						<li><a href="{{URL::to('logout')}}">Logout <i class="icon-lock"></i></a></li>
						<li><a href="{{URL::to('posts/create')}}">Create New Post</a></li>
						
						@else 
						<li><a href="{{URL::to('login')}}">Login</a></li>
						<li><a href="{{URL::to('users/create')}}">Signup</a></li>

						@endif
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Know yourself</a></h1>
					<span class="tag">A road less travelled</span>
				</div>
			</div>
		</div>
	<!-- Header --> 

	<!-- Main -->
		<div id="main">
			@yield("content")
		</div>
	<!-- /Main -->

	<!-- Tweet -->
	<!-- 	<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;Be nice to yourself. It’s hard to be happy when someone is mean to you all the time.&rdquo;</blockquote>
				</section>
			</div>
		</div> -->
	<!-- /Tweet -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
			<!-- 		<header>
						<h2>Get in touch</h2>
						<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
					</header> -->
					<ul class="contact">
						<li><a href="#" class="fa fa-twitter"><span>Twitter</span></a></li>
						<li class="active"><a href="#" class="fa fa-facebook"><span>Facebook</span></a></li>
						<li><a href="#" class="fa fa-dribbble"><span>Pinterest</span></a></li>
						<li><a href="#" class="fa fa-tumblr"><span>Google+</span></a></li>
					</ul>
				</section>
			</div>
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>


	</body>
</html>