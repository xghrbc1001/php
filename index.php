<?php
 session_start();

if(!isset($_SESSION['userid'])){
     header("Location:login.html");
     exit();
}
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Macksocky's funhekle</title>
	<link rel="stylesheet" href="css/index.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="layer/layer.js"></script>
</head>
<body>
	<div class="top">
		<div class="middle">
		<div class="fl">
			<h1>Macksocky's funhekle</h1>
			<h2>funhekle: your personal hackler that won't rest until you're actively livin life and having tremendovs amount of fun</h2>
		</div>
		<div class="fr headerLogin">
			<?php echo $_SESSION['username']; ?>
			<br/>
			<a href="logout.php">LOG OUT</a>
		</div>
		</div>
	</div>
	<div class="nav">
		<div class="middle">
		<div class="fl">
		<a href="javascript:void(0)" id="addLv1" parent_id='0'><img src="imgs/add.png" /></a>
		</div>
		<ul class="fr">
			<li><a href="#">category view</a></li>
			<li><a href="#">category view(in development)</a></li>
			<li class="end"><a href="#">show/hide completed</a></li>
		</ul>
		</div>
	</div>
	<div class="container">
		<div class="middle">
			<ul id="todolist">
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		var uid=<?php echo $_SESSION['userid']; ?>;
		var parent_id=0;
		var tid=0;
	</script>
	<script type="text/javascript" src="js/index.js"></script>
</body>
</html>


