<?php

require_once 'config.php';

class DataBase{
	public function getNbPages($nb_per_page=10, $id_Blog=0){
		$db = $this->getData();
		$posts = $db->prepare('select COUNT(BLOG_POST_ID) AS nb FROM BLOG_POST');
		$posts->execute();
		
		if ($posts->rowCount() == 1){
			return array('nb' => ceil(intval($posts->fetch())/10));; 
		}
		else {
			throw new Exception("Error SQL ");
		}
	}

	// Renvoie la liste des billets du blog
	public function getPosts($page_nb=0, $nb_per_page=10, $id_Blog=0) {
		$db = $this->getData();
		$offset=$page_nb*$nb_per_page;
		$posts = $db->prepare('select BLOG_POST_ID as id, BLOG_POST_DATE as date, BLOG_POST_AUTHOR as author,'
		. ' BLOG_POST_PHOTO as photo, BLOG_POST_TITLE as title, BLOG_POST_PREVIEW as preview, BLOG_POST_DATA as data from BLOG_POST'
		. ' order by BLOG_POST_DATE desc LIMIT :offset, :limit');
		$posts->bindValue(':offset', intval($offset), PDO::PARAM_INT);
		$posts->bindValue(':limit', intval($nb_per_page), PDO::PARAM_INT);
		$posts->execute();
		return $posts;
		// test seting
		/*return array(
		1=>  array('id' => 1, 'date' => '01-11-2017', 'photo' => 'uploads/ima01.jpg', 'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin,', 'title' => 'Titre 1', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
		2=>  array('id' => 2, 'date' => '01-11-2017', 'photo' => 'uploads/ima01.jpg', 'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin,', 'title' => 'Titre 2', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'),
		3=>  array('id' => 3, 'date' => '02-11-2017', 'photo' => 'uploads/ima01.jpg', 'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin,', 'title' => 'Titre 3', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis leo sagittis. Pellentesque ac tellus eget nunc efficitur ultrices in sed ante. Curabitur et fringilla odio, ut venenatis neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent pellentesque, metus non pulvinar laoreet, dui nunc semper neque, eget pharetra felis mi in leo. Vivamus ipsum erat, sollicitudin id leo quis, sollicitudin interdum justo. Aliquam erat volutpat. Etiam dapibus tristique tortor, id consectetur eros bibendum nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.')
	  );*/
	}

	// Return array of the post
	public function getPost($id_Post, $id_Blog=0) {
		$db = $this->getData();
		$post = $db->prepare('select BLOG_POST_ID as id, BLOG_POST_DATE as date, BLOG_POST_AUTHOR as author,'
		. ' BLOG_POST_PHOTO as photo, BLOG_POST_TITLE as title, BLOG_POST_PREVIEW as preview, BLOG_POST_DATA as data from BLOG_POST'
		. ' where BLOG_POST_ID= :id');
		$post->execute(array('id' => $id_Post));
		if ($post->rowCount() == 1){
			return $post->fetch(); 
		}
		else {
			throw new Exception("No post for the ID : " . $id_Post);
		}
	  // test seting
	  //return array('id' => $id_Post, nav => array('title' => 'Blog and CV', 'menu' => 'Menu'), 'date' => '01-11-2017', 'photo' => 'uploads/ima01.jpg', 'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin,', 'title' => 'Titre '.$id_Post, 'data' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu. Morbi non erat consectetur, sollicitudin massa sit amet, finibus mi. Proin accumsan bibendum elit venenatis elementum. Pellentesque lobortis diam vitae mollis tempor. Duis id nisi faucibus, consequat eros non, porttitor tortor. Donec sollicitudin est a ornare commodo. Phasellus vel nisi magna. Maecenas sed risus nec metus blandit pellentesque vel eu ante. Nam nisi dolor, bibendum ut venenatis nec, euismod ut velit. Vivamus facilisis orci in nulla blandit, sed ornare dui commodo. Cras a gravida quam. Vestibulum ultrices ultrices porttitor. Fusce imperdiet felis vel dolor auctor, vitae venenatis');
	}

	public function setPost($id_post, $data, $blog_id=0) {
		$blog='BLOG_POST';
		$db = $this->getData();
		if($id_post==0) {
			$parts="";
			$keys = array_keys($data);
			$parts = $parts . $blog . "_" . strtoupper($keys[0]);
			for ($i = 1; $i < count($data); ++$i){
				$parts = $parts . ', ' . $blog . "_" . strtoupper($keys[$i]);
			}
			$values  = implode(", :", array_keys($data));
			$sql = 'INSERT INTO '.$blog.' ('.$parts.') VALUES (:'.$values.')';
			$sql = $db->prepare($sql);
			
			$sql->execute($data);
		} else {
			if(0<count($data)){
				$parts = "UPDATE ".$blog." SET ";
				$keys = array_keys($data);
				$first=true;
				for ($i = 0; $i < count($data); ++$i){
					$value=$data[$keys[$i]];
					if($value!=""){
						if($first){
							if(is_integer($value)){
								$parts = $parts . $blog . "_" . strtoupper($keys[$i]) . " = ".strval($value);
							} else {
								$parts = $parts . $blog . "_" . strtoupper($keys[$i]) . " = '".$value . "'";
							}
							$first=false;
						} else {
							if(is_integer($value)){
								$parts = $parts . ", ". $blog . "_" . strtoupper($keys[$i]) . " = ".strval($value);
							} else {
								$parts = $parts . ", ". $blog . "_" . strtoupper($keys[$i]) . " = '".$value . "'";
							}
						}
					}
				}
				$parts = $parts . " WHERE BLOG_POST_ID = ".$id_post;
				
				$db->query($parts);
			}
		}
		
		return $db->lastInsertId();
		
	}

	public function getSite() {
		$links = array(array('name' => 'CV', 'href' => 'index.php#cv'),array('name' => 'Projets', 'href' => 'index.php#blog'),array('name' => 'Blog', 'href' => 'index.php?blog=0'),array('name' => 'New Post', 'href' => 'index.php?edit=0'),array('name' => 'Contact', 'href' => 'index.php#contact'));
		return array('nav' => array('title' => 'Blog and CV', 'menu' => 'Menu', 'links' => $links));
	}

	// Return array of the page
	public function getPage($id_Page) {
	  /*$db = getData();
	  $post = $db->prepare('select PAGE_ID as id, PAGE_TITLE as title, PAGE_PHOTO as picture, PAGE_STITLE as subtitle,'
		. ' PAGE_MENUN as menu, PAGE_CV as id_cv, PAGE_BLOG as id_blog, PAGE_FOOT as id_footer from BLOG_POST'
		. ' where PAGE_ID=?');
	  $post->execute(array($id_Page));
	  if ($post->rowCount() == 1)
		$post = $post->fetch();
		if(id_cv!=0){
			$post_cv = $db->prepare('select CV_ID as id, CV_TITLE as title, CV_PHOTO as photo, PAGE_STITLE as subtitle,'
				. ' PAGE_MENUN as menu, PAGE_CV as id_cv, PAGE_BLOG as id_blog, PAGE_FOOT as id_footer from BLOG_POST_CV'
				. ' where PAGE_ID=?');
			if ($post_cv->rowCount() == 1){$post_cv = $post_cv->fetch();}else{throw new Exception("Post " . $id_Page . " corupted");}
		}
		return $post+array('cv' => $post_cv, 'blog' => $post_blog, 'footer' => $post_footer); 
	  else
	   throw new Exception("No post for the ID : " . $id_Page);*/
		// test seting
		$cv = array('title' => 'My CV Online','infos' => array(array('name' => 'First Name', 'text' => 'Boby'),array('name' => 'Familly Name', 'text' => 'Bob'),array('name' => 'Age', 'text' => '19 year old')),'photo' => 'uploads/photo.png','url' => 'uploads/CV.pdf','text' => 'Donload my CV',);
		$blog = array('name' => 'My Projects', 'intro' => '<br/><br/>');
		$footer = array('location' => 'Location', 'adresse1' => '3481 Melrose Place ', 'adresse2' => 'Beverly Hills, CA 90210', 'phonename' => 'Phone', 'phone' => '06 567 566', 'socials' => 'AROUND THE WEB', 'contactname' => 'CONTACT ME');
		return array('id' => 1, 'title' => 'Blog and CV', 'picture' => 'uploads/logo.png', 'subtitle' => 'Devloper PHP7/Symphony2', 'cv' => $cv, 'blog' => $blog, 'footer' => $footer)+$this->getSite();
	}


	// Instancy with PDO
	private function getData() {
		include("blog-model/db-vars/db-config.php"); 
		$db = new PDO('mysql:host='.SQL_HOST.';dbname='.SQL_BASE.';charset=utf8', 
		$db_login, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		unset ($db_login, $db_pass); 
		return $db;
	}
}