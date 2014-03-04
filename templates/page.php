<?php

/**
 * File       page.php
 * Created    3/3/14 12:24 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

$baseUrl = $app->request->getRootUri();
?>
<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title><?php echo $page->title ?></title>
	<link rel="stylesheet" href="<?php echo $baseUrl ?>/style.css" type="text/css" />
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="header-row">
	<header role="banner">
		<div class="logo">
			<a href="<?php echo $app->request->getRootUri(); ?>" title="">matt-thomas.me</a>
			<small>v0.4</small>
		</div>

	</header>
</div>
<div class="nav-row">
	<nav role="navigation">
		<ul>
			<li><a href="<?php echo $baseUrl ?>/about">About</a></li>
			<li><a href="<?php echo $baseUrl ?>/posts">Posts</a></li>
			<li><a href="<?php echo $baseUrl ?>/talks">Talks</a></li>
		</ul>
	</nav>
</div>
<div class="main-row">
	<main role="main">
		<?php
		foreach ($page->content as $content)
		{
			echo $content;
		}
		?>
	</main>
</div>
<div class="footer-row">
	<footer role="contentinfo">

		<nav class="footer-menu">

		</nav>

	</footer>
</div>

<div class="credit-row">
	<section>

		<ul class="social">

			<li><a class="twitter" href="" title="Follow me on Twitter" target="_blank"></a></li>

			<li><a class="dribbble" href="" title="See my latest work at Dribbble" target="_blank"></a></li>

			<li><a class="facebook" href="" title="Annoy me on Facebook" target="_blank"></a></li>

			<li><a class="googleplus" href="" title="Find me on G+" target="_blank"></a></li>

			<li><a class="github" href="" title="All the codez" target="_blank"></a></li>

		</ul>

		<div class="copyright">
			<small>&copy;  </small>
		</div>
	</section>
</div>
<script>
	var _gaq = [
		["_setAccount", ""],
		["_trackPageview"]
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.async = 1;
		g.src = ("https:" == location.protocol ? "//ssl" : "//www") + ".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g, s)
	}(document, "script"));
</script>

</body>
</html>