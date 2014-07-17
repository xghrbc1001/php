<?php
include '../config/config.php';
$id=$_POST['id'];
$title=$_POST['title'];
$content=$_POST['content'];
$star=$_POST['star'];
$parent_id=$_POST['parent_id'];
$user_id=$_POST['user_id'];

$msi=new mysqli(DB_HOST,DB_USER,DB_PW,DB_NAME);
if($msi->cononnect_error){
	die("connect fail".$msi->connect_error);
}
$sql = "replace into todolist(id,title,content,star,parent_id,user_id) values($id,'$title','$content',$star,$parent_id,$user_id)";
$result=$msi->query($sql);
$msi->close();
?>
