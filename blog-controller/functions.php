<?php
require_once 'vendor/autoload.php';
require_once 'blog-model/db-functions.php';
require_once 'config.php';
require_once 'blog-controller/sanitize.php';

class Controller {
	private $dataBase;
	
	function __construct() {
		$this->dataBase=new DataBase();
	}
	
	private function loadTwig($files_path='blog-view'){
		$loader = new Twig_Loader_Filesystem($files_path); 
		$twig = new Twig_Environment($loader, array(
			'cache' => false
		));
		return $twig;
	}

	public function home($posted=false,$result=false){
		$twig = $this->loadTwig();
		
		try{
			$args_home = $this->dataBase->getPage('home');
			$posts = $this->dataBase->getPosts(0,5);
		} catch (Exception $e) {
			require 'blog-view/error_SQL.php';
			exit;
		}
		
		$mail=array();
		if($posted){ 
			if($result){$replie="Message send"; }
			else{ $replie="Error : Message not send"; }
			$mail=$mail+array('replie' => $replie, 'value'=>$_POST);
		}
		
		$template = $twig->loadTemplate('template-home.html.twig');
		echo $template->render($args_home+array('posts'=>$posts)+array('mail'=>$mail)); 
		return '$template';
	}

	public function showBlog($id_blog, $page_nb=1, $nb_per_page=10){
		$twig = $this->loadTwig();
		
		try{
			$args_site = $this->dataBase->getSite();
			$posts = $this->dataBase->getPosts($page_nb,$nb_per_page,$id_blog);
			$nb = $this->dataBase->getNbPages($nb_per_page,$id_blog);
		} catch (Exception $e) {
			require 'blog-view/error_SQL.php';
			exit;
		}
		
		$template = $twig->loadTemplate('template-archive.html.twig');
		echo $template->render($args_site+array('posts'=>$posts, 'nbPage'=>intval($page_nb), 'nbBlog'=>intval($id_blog))+$nb); 
		return '$template';
	}

	public function showPost($idPost,$id_blog=0){
		$twig = $this->loadTwig();
		
		try{
			$args_site = $this->dataBase->getSite();
			$post = $this->dataBase->getPost($idPost,$id_blog);
		} catch (Exception $e) {
			require 'blog-view/error_SQL.php';
			exit;
		}
		
		$template = $twig->loadTemplate('template-post.html.twig');
		echo $template->render($args_site+$post+array('id'=>$idPost)); 
		return '$template';
	}

	public function savePost($idPost,$data){
		$keys = array_keys($data);
		$dataSafe=array();
		for ($i = 0; $i < count($data); ++$i){
			$value=new Sanitize($data[$keys[$i]]);
			if( $keys[$i]=='preview' or $keys[$i]=='data'){
				$dataSafe=$dataSafe+array($keys[$i]=>$value->sanitizeHTML());
			} else {
				$dataSafe=$dataSafe+array($keys[$i]=>$value->sanitizeText());
			}
		}
		return $this->dataBase->setPost($idPost, $dataSafe+array('date'=>date("Y-m-d H:i:s")));
	}

	public function editPost($idPost){
		$twig = $this->loadTwig();
		
		if($idPost!=0){
			$post = $this->dataBase->getPost($idPost);
		} else {
			$post = array();
		}
		
		$template = $twig->loadTemplate('template-admin.html.twig');
		echo $template->render(array('title' => 'Edit', 'message' => '', 'id' => $idPost, 'post' => $post)); 
		return '$template';
	}
	
	public function sendMail($POST){
		// Check for empty fields
		if(empty($POST['name'])  		||
		   empty($POST['email']) 		||
		   empty($POST['phone']) 		||
		   empty($POST['message'])		||
		   !filter_var($POST['email'],FILTER_VALIDATE_EMAIL))
		   {
			echo "No arguments Provided!";
			return false;
		   }
			
		$name = strip_tags(htmlspecialchars($POST['name']));
		$email_address = strip_tags(htmlspecialchars($POST['email']));
		$phone = strip_tags(htmlspecialchars($POST['phone']));
		$message = strip_tags(htmlspecialchars($POST['message']));
			
		// Create the email and send the message
		$to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "Website Contact Form:  $name";
		$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
		$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email_address";
		mail($to,$email_subject,$email_body,$headers);
		return true;
	}
}