<?php 
session_start();
if(isset($_SESSION['admin_name'])){
header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

</head>
<style type="text/css">
	body{
		margin: 0;
		padding: 0;
		background-color: #f1f1f1;
	}
	.box{
		width: 500px;
		padding: 20px;
		background-color: #fff;
	}
</style>
<body>
<div class="container box">
	<h3>Bienvenido <?php echo $_SESSION['admin_name']; ?> </h3>
	<br>
	<p><a href="logout.php">Salir</a></p>
</div>
</body>
</html>