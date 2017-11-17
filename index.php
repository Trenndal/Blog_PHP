<?php

require 'blog-controller/functions.php';
require_once 'config.php';

$controller=new Controller();

if(isset($_GET['edit'])) {
	$idPost = intval($_GET['edit']);
	if(isset($_GET['blog'])) {
		$idBlog = intval($_GET['blog']);
		$controller->editPost($idPost,$idBlog);
	} else {
		if(isset($_GET['action'])) {
			if($idPost==0){
				$controller->editPost($controller->savePost($idPost,$_POST));
			} else {
				$controller->savePost($idPost,$_POST);
				$controller->editPost($idPost);
			}
		} else {
			$controller->editPost($idPost);
		}
	}
} elseif(isset($_GET['post'])) {
	$idPost = intval($_GET['post']);
	if(isset($_GET['blog'])) {
		$idBlog = intval($_GET['blog']);
		$controller->showPost($idPost,$idBlog);
	} else {
		$controller->showPost($idPost);
	}
} elseif(isset($_GET['blog'])) {
	if(isset($_GET['page'])) { $page=$_GET['page'];} else { $page=0; }
	$idBlog = intval($_GET['blog']);
	$controller->showBlog($idBlog,$page);
} else {
	if(isset($_POST['email'])){$controller->home(sendMail($_POST));}
	else { $controller->home(); }
}
