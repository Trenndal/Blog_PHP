<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Installation Step 1</title>
	
	<style>
		html, body {background-color: #ccffcc; height: 100%}
		.main {background-color: #dccccc; width: 80%; min-height: 90%; margin-left:auto; margin-right:auto;}
		h1   {color: blue; text-align:center;}
		form    {color: black; width: 80%; margin-left:auto; margin-right:auto;}
		#progressbar {width:65%;  padding:0px;  background-color:white;  border:2px solid black;  height:2.5em; }
		#indicator {width:30%;  transition: width 2s;  animation-name: anim;  animation-duration: 2s; background:-color: blue;  background: linear-gradient(lightblue,blue,lightblue);  height:100%;  margin:0;}
		#indicator.go {width:50%;}
		@keyframes anim {  from { width: 0%; }  to { width: 30%; }  }
	</style>
	
</head>
<body>
	
	<div class="main">
		<br/><br/>
		<h1>Installation Step 1</h1><br/><br/><br/>
		
		<FORM action="installer.php" method="get" onsubmit="progressBar()">
			<div id="progressbar">
				<div id="indicator" class=""></div>
			</div>
			<p>
				Making SQL tables :
			</p>
			<input type="submit" value="Start"/>
		</FORM>
	</div>
	
	<script>
		function progressBar() {
			document.getElementById("indicator").className = "go";
		}
	</script>
	
</body>
