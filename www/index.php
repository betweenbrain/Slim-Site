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
define('PAGES', realpath(__DIR__ . '/../pages'));

require realpath(__DIR__ . '/../vendor/autoload.php');

$app = new \Slim\Slim(array(
	'mode'           => 'development',
	'templates.path' => realpath(__DIR__ . '/../templates')
));

use \Michelf\Markdown;

$env = $app->environment();

$page = new stdClass;

// Homepage blog layout
$app->get('/', function () use ($app, $env, $page)
	{
		foreach (glob(POSTS . '/*.md') as $post)
		{
			$url             = str_replace('.md', '', basename($post));
			$title           = ucwords(str_replace('-', ' ', $url));
			$page->content[] = '<p><a href="post/' . $url . '">' . $title . '</a></p>';
			$page->title     = 'blog';
		}
		$app->render('page.php', array('app' => $app, 'page' => $page));
	}
);

// Individual blog page
$app->get('/post/:name', function ($name) use ($app, $env, $page)
	{
		if (file_exists(POSTS . '/' . $name . '.md'))
		{
			$page->content[] = Markdown::defaultTransform(file_get_contents(POSTS . '/' . $name . '.md'));
			$page->title     = ucwords(str_replace('-', ' ', $name));
			$app->render('page.php', array('app' => $app, 'page' => $page));
		}
		else
		{
			// Throws a 404 - http://docs.slimframework.com/#Route-Helpers
			$app->pass();
		}
	}
);

// Individual pages
$app->get('/:name', function ($name) use ($app, $env, $page)
	{
		if (file_exists(PAGES . '/' . $name . '.md'))
		{
			$page->content[] = Markdown::defaultTransform(file_get_contents(PAGES . '/' . $name . '.md'));
			$page->title     = ucwords(str_replace('-', ' ', $name));
			$app->render('page.php', array('app' => $app, 'page' => $page));
		}
		else
		{
			// Throws a 404 - http://docs.slimframework.com/#Route-Helpers
			$app->pass();
		}
	}
);

$app->run();