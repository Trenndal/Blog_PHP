<?php

$db_host="localhost";
$db_base="myblog";
$db_login="root";
$db_pass="";
$err="";
$step=1;

function setVar(){
	$db_host="localhost";
	$db_base="myblog";
	$db_login="root";
	$db_pass="";
	$step=1;
}

function getData() {
	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_base.';charset=utf8', 
		$db_login, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	return $db;
}
function setPostsTable(){
	$db=getData();
	$sql=$db->prepare('CREATE TABLE BLOG_POST (BLOG_POST_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, BLOG_POST_DATE DATETIME, BLOG_POST_PHOTO varchar(127), BLOG_POST_TITLE varchar(255), BLOG_POST_PREVIEW varchar(255), BLOG_POST_DATA LONGTEXT CHARACTER SET utf8);');
	$sql->execute();
}
function setPostsEx(){
	$db=getData();
	$values=date("Y-m-d H:i:s")."', 'uploads/ima01.jpg', 'Titre1', "
		."'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', "
		."'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque, lacus ac feugiat sollicitudin, erat mi maximus lorem, eu pretium eros leo in leo. Suspendisse nisl mauris, vestibulum a porttitor at, commodo non arcu.";
	
	$sql=$db->prepare("INSERT INTO BLOG_POST (BLOG_POST_DATE, BLOG_POST_AUTHOR, BLOG_POST_PHOTO, BLOG_POST_TITLE, BLOG_POST_PREVIEW, BLOG_POST_DATA) VALUES ('".date("Y-m-d H:i:s")."', 'uploads/ima01.jpg', 'Titre1', 'Suspendisse nisl mauris, vestibulum', 'Suspendisse nisl mauris, vestibulum Suspendisse nisl mauris, vestibulum')");
	$sql->execute();
}
function getStep() {
	if(isset($_GET['step'])) {$step=intval($_GET['step']);return $_GET['step'];} else {$step=1;return '1';}
}
$step=intval(getStep());

if(isset($_GET['step']) and intval($_GET['step'])==2) {
	$db_host=$_POST['host'];
	$db_base=$_POST['base'];
	$db_login=$_POST['login'];
	$db_pass=$_POST['password'];
	try {setPostsTable();} catch(Exception $e) { $step=1; $err="Fail to create the DataBase : ".$db_base; }
}


$style1='""';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Installation Step <?php  $step; ?></title>
	
	<style>
		body {background-color: #ccffcc; height: 100%}
		input {width: 80%;}
		.main {background-color: #dccccc; width: 80%; min-height: 50%; margin-left:auto; margin-right:auto;}
		h1   {color: blue; text-align:center;}
		form    {color: black; width: 80%; margin-left:auto; margin-right:auto;}
		#progressbar {width:96%;  padding:0px;  background-color:white;  border:2px solid black;  height:2.5em; }
		#indicator {width:30%;  transition: width 2s;  animation-name: anim;  animation-duration: 2s; background:-color: blue;  background: linear-gradient(lightblue,blue,lightblue);  height:100%;  margin:0;}
		#indicator.go {width:50%;}
		@keyframes anim {  from { width: 0%; }  to { width: 30%; }  }
	</style>
	
</head>
<body>
	
	<div class="main">
		<br/><br/>
		<h1>Installation Step <?php echo $step; ?></h1>
		<p style="text-align:center;"><?php
			echo '<span style="color:red;font-weight: bold;"> '.$err.' <br/><br/></span>';
			if ($step==1) echo 'Making SQL tables :';
			elseif ($step==2) echo 'SQL tables created !';
		?></p><br/><br/>
		<FORM action=<?php echo "installer.php?step=".strval($step+1); ?> method="post" onsubmit="progressBar()">
			<div id="progressbar">
				<div id="indicator" class=""></div>
			</div>
			<br/>
			<br/>
			<table style="width:100%; text-align:right;">
			<tr style=<?php echo $style1; ?>><th>Host name : </th><th> <input type="text" name="host" value=""/></th></tr>
			<tr style=<?php echo $style1; ?>><th>DB name : </th><th> <input type="text" name="base" value=""/></th></tr>
			<tr style=<?php echo $style1; ?>><th>Login : </th><th> <input type="text" name="login" value=""/></th></tr>
			<tr style=<?php echo $style1; ?>><th>Password : </th><th> <input type="text" name="host" value=""/></th></tr>
			<tr><th><br/></th></tr>
			<tr><th></th><th> <?php
			if ($step<2){
				if($step==1){$b='start';}
				else { $b='Next step'; }
				echo '<input type="submit" value="'.$b.'" style="min-height:30px; min-width:80%;"/>';
			}
			?></th></tr>
			</table>
		</FORM>
		<br/>
	</div>
	
	
	
	<script>
		function progressBar() {
			document.getElementById("indicator").className = "go";
		}
	</script>
	
</body>
