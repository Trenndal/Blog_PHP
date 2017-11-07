<?php

require 'blog-controller/functions.php';

if(isset($_GET['post'])) {
	$idPost = intval($_GET['post']);
	if(isset($_GET['blog'])) {
		$idBlog = intval($_GET['blog']);
		showPost($idPost,$idBlog);
	} else {
		showPost($idPost);
	}
} elseif(isset($_GET['blog'])) {
	$idBlog = intval($_GET['blog']);
	showBlog($idBlog);
} else {
	home();
}