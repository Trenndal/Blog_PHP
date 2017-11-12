<?php
require_once 'vendor/autoload.php';
require_once 'blog-model/db-functions.php';

function loadTwig($files_path='blog-view'){
	$loader = new Twig_Loader_Filesystem($files_path); 
	$twig = new Twig_Environment($loader, array(
		'cache' => false
	));
	return $twig;
}

function home(){
	$twig = loadTwig();
	
	$args_home = getPage('home');
	$posts = getPosts();
	
	$template = $twig->loadTemplate('template-home.html.twig');
	echo $template->render($args_home+array('posts'=>$posts)); 
	return '$template';
}

function showPost($idPost){
	$twig = loadTwig();
	
	$post = getPost($idPost);
	
	$template = $twig->loadTemplate('template-post.html.twig');
	echo $template->render($post); 
	return '$template';
}

function editPost($idPost){
	$twig = loadTwig();
	
	//$post = getPost($idPost);
	
	$template = $twig->loadTemplate('template-admin.html.twig');
	echo $template->render(array('title' => 'Edit', 'message' => '')); 
	return '$template';
}
