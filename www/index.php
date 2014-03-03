<?php

/**
 * File       index.php
 * Created    3/3/14 11:49 AM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

define('POSTS', realpath(__DIR__ . '/../posts'));

require realpath(__DIR__ . '/../vendor/autoload.php');

$app = new \Slim\Slim(array(
	'templates.path' => realpath(__DIR__ . '/../templates')
));

use \Michelf\Markdown;

$env = $app->environment();

// Homepage blog layout
$app->get('/', function () use ($app, $env)
	{
		$app->render('header.php', array('env' => $env));

		foreach (glob(POSTS . '/*.md') as $post)
		{
			$url   = str_replace('.md', '', basename($post));
			$title = ucwords(str_replace('-', ' ', $url));
			echo '<p><a href="post/' . $url . '">' . $title . '</a></p>';
		}

		$app->render('footer.php');
	}
);

// Individual blog page
$app->get('/post/:name', function ($name) use ($app, $env)
	{
		$app->render('header.php', array('env' => $env));

		if (file_exists(POSTS . '/' . $name . '.md'))
		{
			$app->render('post.php', array('post' => Markdown::defaultTransform(file_get_contents(POSTS . '/' . $name . '.md'))));
		}
		else
		{
			// Throws a 404 - http://docs.slimframework.com/#Route-Helpers
			$app->pass();
		}

		$app->render('footer.php');
	}
);

$app->run();