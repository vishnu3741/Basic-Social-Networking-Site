<?php 
	$receiver = $_POST["receiver_id"];
	$sender = $_POST["sender_id"];
?>
<html> 
<head> 
<title>Chat with </title> 
<link rel="stylesheet" href="./notification-demo-style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<style>
*{ padding: 0; margin: 0; border: 0; }
body{ background: white; } 
.content {
	height:auto;
    margin-left: 300px;
	padding-left: 20px;
	background:white;
	position: relative;
	
}
.sidenav {
    height: 100%;
    width: 300px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: AliceBlue;
    overflow-x: hidden;
}
#chat_box{ 
	width: 90%; 
	height: 400px; }
#chat_data{ 
	width: 100%;
	padding: 5px;
	margin-bottom: 5px;
	border-bottom: 1px solid silver;
	font-weight: bold; } 
input[type="Number"]{
	width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;}
input[type="Number"]:hover {
    background-color: #45a049;
}
input[type="text"]{     
	width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;}
input[type="submit"]{     
	width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
	cursor: pointer; }
    .content {
	height:auto;
    margin-left: 300px;
	padding-left: 20px;
	background:white;
	position: relative;
	
}
.sidenav {
    height: 100%;
    width: 300px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color:  #111;
    overflow-x: hidden;
}
.button{
 
    border: none;
    color:  #818181;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button:hover{
  color: #f1f1f1;
}
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 70%;
  background: #f1f1f1;
}
form.example button {
  float: right;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}
@media screen{
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 22px;}
}
input[type="submit"]:hover {
    background-color: #45a049;
}
textarea{ width: 100%; height: 40px; border: 1px solid grey; border-radius: 5px; }
</style>
<script> 
	function chat_ajax(){
		 
		var sender_id = <?php echo $sender ?>;
		var receiver_id = <?php echo $receiver ?>;
		
		var req = new XMLHttpRequest(); 
		req.onreadystatechange = function() { 
			if(req.readyState == 4 && req.status == 200){ 
				document.getElementById('chat_box').innerHTML = req.responseText;
				 }
			 } 
		req.open('GET', 'chat.php?sender_id='+sender_id+'&receiver_id='+receiver_id, true); 
		req.send(); 
	} 
	setInterval(function(){chat_ajax()}, 1000) 
</script>
</head>
 <body> 
 <div class="sidenav">
<form class="example" action="./live_search.php" method="post">
    <input type="text" name="string" placeholder="Search for people..."/>
    <button type="submit" value="submit" ><i class="fa fa-search"></i></button></form>
    <a href="./home.php" class="button">Home</a><br>
    <a href="./scroll.php" class="button">Feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
    <a href="./followed_people.php" class="button" rel="modal:open">Chat</a><br>
    <a href="./logout.php" class="button">Logout</a>
    </div>
<div id="container" class="content">

	<br>
		 <br>
		 <form name="messageform" method="post" action="message_form.php"> 
			  <input type="hidden" name="receiver_id" value="<?php echo $_POST['receiver_id'] ?>" >
			  <input type="hidden" name="sender_id" value="<?php echo $sender ?>" >
			  <textarea name="message" placeholder="Enter Message....."></textarea> 
			  <br><br>
			  <input type="submit" name="submit" value="Send!" /> 
		 </form>
		 <?php
			if(isset($_POST['submit'])){
				if($_POST['message'] == ''){
					echo "<script type='text/javascript'>alert(\"Fields are mandatory\");</script>";
				}
				else{
					$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
					$dbconn = pg_connect($conn_string);
					$msg = $_POST['message'];
					$name = $_POST['receiver_id'];
					$query_2 = "insert into personal_messages (sender_id,receiver_id,sent_msg,seen) values ( ".$sender.", ".$receiver.",'".$msg."'".",0 )";
					$result_2 = pg_query($dbconn,$query_2);
					$_POST['name'] = '';
					$_POST['message']='';
				}
			}
		 ?> 
	<div id="chat_box">
	</div> 
</div>
 
		
</body> 
</html>
