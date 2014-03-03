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

$app = new \Slim\Slim;
use \Michelf\Markdown;

$app->config(
	array(
		'templates.path' => realpath(__DIR__ . '/../templates')
	)
);

$app->get('/post/:name', function ($name) use ($app)
{
	if (file_exists(POSTS . '/' . $name . '.md'))
	{
		$app->render('post.php', array('post' => Markdown::defaultTransform(file_get_contents(POSTS . '/' . $name . '.md'))));
	}
	else
	{
		// Throws a 404 - http://docs.slimframework.com/#Route-Helpers
		$app->pass();
	}
}
);

$app->run();