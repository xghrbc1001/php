<?php
include '../config/config.php';
include 'todolist.php';

$toDoList = new ToDoList;

$user_id=$_GET['uid'];
$id=$_GET['id'];
$msi=new mysqli(DB_HOST,DB_USER,DB_PW,DB_NAME);
if($msi->cononnect_error){
	die("connect fail".$msi->connect_error);
}

$sql = "select id,title,content,star,parent_id,user_id from todolist where id=$id ";
$res=$msi->query($sql);

if($res && $res->num_rows>0){
while($row= $res->fetch_array()){
	$toDoList = new ToDoList;
	$toDoList->id=$row[0];
	$toDoList->title=$row[1];
	$toDoList->content=$row[2];
	$toDoList->star=$row[3];
	$toDoList->parent_id=$row[4];
	$toDoList->user_id=$row[5];
}
}
$json=json_encode($toDoList);
echo $json;
$res->free();
$msi->close();
?>
