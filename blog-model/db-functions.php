<?php

// Renvoie la liste des billets du blog
function getPosts() {
/*  $db = getData();
  $posts = $db->query('select BIL_ID as id, BIL_DATE as date,'
    . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
    . ' order by BIL_ID desc');
  return $billets;*/
  // test seting
  return array(
	  array('id' => 1, 'date' => '01-11-2017', 'title' => 'Titre 1', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
	  array('id' => 2, 'date' => '01-11-2017', 'title' => 'Titre 2', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
	  array('id' => 3, 'date' => '02-11-2017', 'title' => 'Titre 3', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.')
  );
}

// Return array of the post
function getPost($id_Post) {
  $db = getData();
  $post = $db->prepare('select BIL_ID as id, BIL_DATE as date,'
    . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
    . ' where BIL_ID=?');
  $post->execute(array($id_Post));
  if ($post->rowCount() == 1)
    return $post->fetch(); 
  else
   throw new Exception("No post for the ID : " . $id_Post);
}

// Return array of the page
function getPage($id_Page) {
	// test seting
	$cv = array('title' => 'My CV Online','infos' => array(array('name' => 'First Name', 'text' => 'Boby'),array('name' => 'Familly Name', 'text' => 'Bob'),array('name' => 'Age', 'text' => '19 year old')),'photo' => 'uploads/photo.jpg','url' => 'uploads/CV.pdf','text' => 'Donload my CV',);
	$blog = array('name' => 'My Projects', 'intro' => '<br/><br/>');
	$footer = array('location' => 'Location', 'adresse1' => '3481 Melrose Place ', 'adresse2' => 'Beverly Hills, CA 90210', 'phonename' => 'Phone', 'phone' => '06 567 566', 'socials' => 'AROUND THE WEB', 'contactname' => 'CONTACT ME');
	return array('id' => 1, 'title' => 'Blog and CV', 'picture' => '', 'subtitle' => '', 'menu' => 'Menu', 'cv' => $cv, 'blog' => $blog, 'footer' => $footer);
}


// Instancy via PDO
function getData() {
  $db = new PDO('mysql:host=localhost;dbname=myblog;charset=utf8', 
  'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  return $db;
}