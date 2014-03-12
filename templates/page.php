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
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset=utf-8 />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Matt Thomas"">
	<meta name="description" content="matt.thomas.me" />
	<meta name="handheldfriendly" content="True" />
	<meta name="mobileoptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="x-ua-compatible" content="IE=edge;chrome=1" />
	<meta name="cleartype" content="on" />
	<meta name="generator" content="Slim Site - https://github.com/betweenbrain/Slim-Site" />
	<title><?php echo $page->title ?></title>
	<link rel="stylesheet" href="<?php echo $baseUrl ?>/style.css" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400" type="text/css" />
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="header-row">
	<header role="banner">
		<div class="logo">
			<a href="<?php echo $baseUrl ?>/" title="">matt-thomas.me</a>
			<small>v0.4</small>
		</div>
		<nav role="navigation">
			<ul class="nav menu">
				<li><a href="<?php echo $baseUrl ?>/about">About</a></li>
				<li><a href="<?php echo $baseUrl ?>/posts">Posts</a></li>
				<li><a href="<?php echo $baseUrl ?>/talks">Talks</a></li>
			</ul>
		</nav>
	</header>
</div>

<div class="main-row">
	<main role="main">
		<?php foreach ($page->content as $content) : ?>
			<article class="article">
				<?php if(isset($page->metadata)) : ?>
				<header>
					<h1><?php echo $page->metadata['title'] ?></h1>
				</header>

				<footer>
					<ul class="article-meta">
					</ul>
				</footer>
				<?php endif ?>
				<div class="article-body">
					<?php echo $content ?>
				</div>
			</article>
		<?php endforeach ?>
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
			<li>
				<a class="twitter" href="https://twitter.com/betweenbrain" title="Follow me on Twitter" target="_blank"></a>
			</li>
			<li>
				<a class="googleplus" href="https://plus.google.com/+MattThomasMe" title="Find me on G+" target="_blank"></a>
			</li>
			<li><a class="github" href="https://github.com/betweenbrain" title="All the codez" target="_blank"></a></li>
		</ul>

		<div class="copyright">
			<small>&copy; <?php echo date('Y'); ?> Matt Thomas</small>
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