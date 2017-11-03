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
	
	$template = $twig->loadTemplate('template-home.html.twig');
	echo $template->render($args_home+array('posts'=>$posts)); 
	return '$template';
}

function showPost($idPost){
	$loader = new Twig_Loader_Filesystem('blog-view'); 
	$twig = new Twig_Environment($loader, array(
		'cache' => false
	));
	$post = getPost($idPost);
	
	$template = $twig->loadTemplate('template-post.html.twig');
	echo $template->render($post); 
	return '$template';
}
