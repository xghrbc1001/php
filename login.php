<?php
if(!isset($_POST['submit'])){
    exit('wrong request');
}
include 'config/config.php';
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);

$msi=new mysqli(DB_HOST,DB_USER,DB_PW,DB_NAME);
if($msi->cononnect_error){
die("connect fail".$msi->connect_error);
}

$sql = "select id from user where username='$username' and password='$password' limit 1";
$res=$msi->query($sql);

session_start();
if($res && $res->num_rows>0){
while($row= $res->fetch_array()){
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $row[0];
    header("Location:index.php");
}
}

// close connection
$res->free();
$msi->close();

?>
