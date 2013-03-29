<?php
	//Use a session to keep track of user preferences...
	session_start();
	$_SESSION['version'] = (isset($_GET['version']) ? $_GET['version'] : $_SESSION['version']);
	$_SESSION['app']     = (isset($_GET['app']) ? $_GET['app'] : $_SESSION['app']);
	
	//If the user is in the mobile version... maybe they want to know about the Android/iPad App?
	$overlay = '';
	if($_SESSION['version'] != 'desk' && $_SESSION['app'] != 'closed'):
		include_once 'Mobile_Detect.php';
		$detect = new Mobile_Detect();
		if($detect->isAndroidOS()){
			$overlay = 'android';
		} else if($detect->iOS() || 1==1) {
			$overlay = 'ios';
		}
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Demo</title>
<style>
/* Base Styles */
*{
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
}
html, body{
	margin:0;
	padding:0;
	font-size:100%;
}
.overlay{
	width:100%;
	height:100%;
	position:fixed;
	background:rgba(0,0,0,.8);
	background-size:contain;
	background-repeat:no-repeat;
	background-position:center center;
	display:none;
	
}
.overlay.android{
	display:block;
	background-image:url('android.png');
}
.overlay.ios{
	display:block;
	background-image:url('apple.png');
}


.wrapper, header, footer{
	width:100%;
	min-width:320px;
}
header{
	margin-bottom:.5em;
}
.logo{
	width:40px;
	height:40px;
	margin:0;
	padding:0;
	display:inline-block;
	border-radius:100px;
	text-indent:-999em;
	background-color:#556;
	background-image: -webkit-linear-gradient(60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(-60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(-60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(30deg, #99a 25%, transparent 25.5%, transparent 75%, #99a 75%, #99a), 
	-webkit-linear-gradient(30deg, #99a 25%, transparent 25.5%, transparent 75%, #99a 75%, #99a);
	background-size:80px 140px;
	background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;; background-color:#556;
	background-image: -webkit-linear-gradient(60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(-60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(-60deg, #445 12%, transparent 12.5%, transparent 87%, #445 87.5%, #445),
	-webkit-linear-gradient(30deg, #99a 25%, transparent 25.5%, transparent 75%, #99a 75%, #99a), 
	-webkit-linear-gradient(30deg, #99a 25%, transparent 25.5%, transparent 75%, #99a 75%, #99a);
	background-size:80px 140px;
	background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;
}
nav {
  position: relative;
	top:-16px;
	left:10px;
	display:inline-block;
  padding-left: 1.25em;
	cursor:pointer;
}
nav:before {
  content: "";
  position: absolute;
  top: 0.25em;
  left: 0;
  width: 1em;
  height: 0.125em;
  border-top: 0.375em double #000;
  border-bottom: 0.125em solid #000;
}

nav ul{
	list-style:none;
	display:none;
}

.page{
	width:100%;
	margin:0 auto;
}
.content{
	width:100%;
	border:1px solid red;
	padding:1em;
}
.sidebar{
	width:100%;
	border:1px solid blue;
	padding:1em;
}
footer{
	background-image: -webkit-linear-gradient(to bottom right, red, rgba(255,0,0,0));
	padding:1em .5em;
}
<?php if($_SESSION['version'] != 'desk'): ?>
@media only screen and (min-width : 500px) { /* Bigger than phones */
<?php endif; ?>
	.wrapper{
		min-width:500px;
		padding:0 2em;
	}
	.logo{
		width:100px;
		height:100px;
	}
	nav{
		position: static;
		display:block;
	  padding:1em 0 0 0;
		cursor:default;
	}
	nav:before{
		display:none;
	}
	nav ul{
		display:block;
		margin:0;
		padding:0;
	}
	nav li{
		display:inline-block;
		margin:0 0.8em;
	}
	nav li:first-child{
		margin-left:0;
	}
	nav li:last-child{
		margin-right:0;
	}
	.content{
		width:62%;
		display:inline-block;
		vertical-align:top;
		padding:5em;
	}
	.sidebar{
		width:38%;
		display:inline-block;
		text-align:center;
		padding:5em;
	}
<?php if($_SESSION['version'] != 'desk'): ?>
}
<?php endif; ?>
</style>
</head>
<body>
<div class="overlay <?php echo $overlay; ?>"></div>
<div class="wrapper">
  <header>
    <h1 class="logo">My Company Logo</h1>
    <nav>
      <ul>
        <li>Home</li><li>About Us</li><li>Services</li><li>Contact Us</li><?php
				if($_SESSION['version'] == 'desk'): //If true, use link to give option to revert to mobile.
				?><li><a href="?version=mobi">Mobile Version</a></li><?php
				else:
				?><li><a href="?version=desk">Desktop Version</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <article class="page">
    <section class="content">
    Super Cool Content!!!!
    </section><aside class="sidebar">
    Super Awesome Sidebar
    </aside>
  </article>
  <footer>&copy; <?php echo date('Y'); ?> My Site</footer>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$('.overlay').click(function(){
	window.location = '?app=closed';
});
</script>
</body>
</html>