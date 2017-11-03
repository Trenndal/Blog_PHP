<?php
require_once 'vendor/autoload.php';
require 'blog-model/db-functions.php';

function home(){
	$loader = new Twig_Loader_Filesystem('blog-view'); 
	$twig = new Twig_Environment($loader, array(
		'cache' => false
	));
	$args_home = getPage('home');
	$posts = getPosts();
	array_merge($args_home->blog,array('posts' => $posts));

	$template = $twig->loadTemplate('template-home.html.twig');
	echo $template->render($args_home); 
	return '$template';
}
