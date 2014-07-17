<?php
include '../config/config.php';
include 'todolist.php';

$user_id=$_GET['uid']; 
$msi=new mysqli(DB_HOST,DB_USER,DB_PW,DB_NAME);
if($msi->cononnect_error){
	die("connect fail".$msi->connect_error);
}

$sql = "select id,title,content,star,parent_id,user_id from todolist where user_id=$user_id and parent_id=0";
$res=$msi->query($sql);

$toDoLists=array();
if($res && $res->num_rows>0){
	while($row= $res->fetch_array()){
	$toDoList = new ToDoList();
	$toDoList->id=$row[0];
	$toDoList->title=$row[1];
	$toDoList->content=$row[2];
	$toDoList->star=$row[3];
	$toDoList->parent_id=$row[4];
	$toDoList->user_id=$row[5];
	array_push($toDoLists,$toDoList);

	if($row[4]!=0){
		continue;
	}
	// lev2
	$sqlLev2 = "select id,title,content,star,parent_id,user_id from todolist where user_id=$user_id and parent_id=$row[0]";
	$resLev2=$msi->query($sqlLev2);
	if($resLev2 && $resLev2->num_rows>0){
		while($rowLev2= $resLev2->fetch_array()){
			$toDoList = new ToDoList();
			$toDoList->id=$rowLev2[0];
			$toDoList->title=$rowLev2[1];
			$toDoList->content=$rowLev2[2];
			$toDoList->star=$rowLev2[3];
			$toDoList->parent_id=$rowLev2[4];
			$toDoList->user_id=$rowLev2[5];
			array_push($toDoLists,$toDoList);
		}
	}
	$resLev2->free();
}
}
$json = $json=json_encode($toDoLists); 

echo $json;
$res->free();
$msi->close();
?>
