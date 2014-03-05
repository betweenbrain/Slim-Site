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
		foreach (array_slice(array_reverse(glob(POSTS . '/*.md')), 0, 3) as $key => $post)
		{
			$metadata            = parseMetadata(file_get_contents($post));
			$url                 = str_replace('.md', '', basename($post));
			$page->content[$key] = '<h2><a href="post/' . $url . '">' . $metadata['title'] . '</a></h2>';

			if (isset($metadata['description']))
			{
				$page->content[$key] .= $metadata['description'];
			}
		}
		$page->title = 'blog';
		$app->render('page.php', array('app' => $app, 'page' => $page));
	}
);

// Individual blog page
$app->get('/post/:name', function ($name) use ($app, $env, $page)
	{
		if (file_exists(POSTS . '/' . $name . '.md'))
		{
			$post            = file_get_contents(POSTS . '/' . $name . '.md');
			$content         = substr($post, strrpos($post, '---'), strlen($post));
			$page->content[] = Markdown::defaultTransform($content);
			$page->metadata  = parseMetadata($post);
			$page->title     = $page->metadata['title'];
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
		if ($name == 'posts')
		{
			foreach (array_reverse(glob(POSTS . '/*.md')) as $key => $post)
			{
				$url                 = str_replace('.md', '', basename($post));
				$title               = ucwords(str_replace('-', ' ', substr($url, 11)));
				$page->content[$key] = '<h2><a href="post/' . $url . '">' . $title . '</a></h2>';
				$page->content[$key] .= substr(Markdown::defaultTransform(file_get_contents($post)), 0, 50);
			}
			$page->title = 'blog';
			$app->render('page.php', array('app' => $app, 'page' => $page));
		}
		elseif (file_exists(PAGES . '/' . $name . '.md'))
		{
			$post            = file_get_contents(PAGES . '/' . $name . '.md');
			$content         = substr($post, strrpos($post, '---'), strlen($post));
			$page->content[] = Markdown::defaultTransform($content);
			$page->metadata  = parseMetadata($post);
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

/**
 * Parse markdown file for metadate
 *
 * @param $post
 *
 * @return array|mixed|string
 */
function parseMetadata($post)
{
	$meta     = substr($post, 0, strrpos($post, '---'));
	$meta     = str_replace("---\n", '', trim($meta));
	$meta     = explode("\n", $meta);
	$metadata = null;

	foreach ($meta as $key => $value)
	{
		if (strpos($value, ': '))
		{
			$parts               = explode(': ', $value);
			$metadata[$parts[0]] = $parts[1];
		}
	}

	return $metadata;
}