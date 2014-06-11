<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo ( isset( $title ) ) ? sprintf( '%s | Course Planner', $title) : 'Course Planner'; ?></title>

	<!-- Styles -->
	<link href="<?php echo \App\App::asset( 'css/vendor/bootstrap.min.css' ); ?>" rel="stylesheet">
	<link href="<?php echo \App\App::asset( 'css/main.css' ); ?>" rel="stylesheet">

	<!-- IE Scripts -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo \App\App::url( 'home' ); ?>">Course Planner</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo \App\App::url( 'home' ); ?>">Accueil</a></li>
					<li><a href="<?php echo \App\App::url( 'courses' ); ?>">Mes Cours</a></li>
					<li><a href="<?php echo \App\App::url( 'curriculums' ); ?>">Mes Formations</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="site container">

		<div id="main" class="site-main">
			<?php if ( isset( $title ) ):?>
				<h1 class="page-header"><?php echo  $title; ?></h1>
			<?php endif; ?>
			<?php echo ( isset( $content ) ) ? $content : 'Page content is empty.'; ?>
		</div>

	</div><!-- .container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="<?php echo \App\App::asset( 'js/bootstrap.min.js' ); ?>"></script>
</body>
</html>