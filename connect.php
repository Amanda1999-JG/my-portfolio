<?php
   $Project_ID = $_POST['Project_ID'];
   $Project_Title = $_POST['Project_Title'];
   $Add_Descripton = $_POST['Add_Descripton'];
   $Images = $_POST['Images'];
   
   $conn = new MySQLi('localhost','root','','amanda');
   if($conn->connect_error){
	   die('connection faild : '.$conn->connect_error); 
   }else{
	   $stmt = $conn->prepare("insert into registration(Project_ID, Project_Title, Add_Descripton, Images) values(?, ?, ?, ?)");
	   $stmt->bind_param("isss",$Project_ID, $Project_Title, $Add_Descripton, $Images);
	   $stmt->execte();
	   echo "Registration Succeddfully";
	   $stmt->close();
	   $conn->close();
   }
?>