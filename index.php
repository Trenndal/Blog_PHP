<?php

require 'blog-controller/functions.php';

if (isset($_GET['post'])) {
	$idPost = intval($_GET['post']);
	showPost($idPost);
} else {
	home();
}