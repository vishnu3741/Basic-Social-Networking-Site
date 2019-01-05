<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link rel="stylesheet" href="./navbar.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
</head>
<body>
<div class="sidenav">
    <form class="example" action="./live_search.php" method="post">
    <input type="text" name="string" placeholder="Search for people..."/>
	<button type="submit" value="submit" ><i class="fa fa-search"></i></button></form>
	<a href="./home.php" class="button">Home</a><br>
    <a href="./Posts/scroll.php" class="button">Feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
	<a href="./followed_people.php" class="button" rel="modal:open">Chat</a><br>
	<a href="./logout.php" class="button">Logout</a>
    </div>
<div class="content">
<?php 	
		session_start();
		$user_id = $_SESSION["user_id"];
		$sender_id = $_REQUEST['sender_id'];
		$receiver_id = $_REQUEST['receiver_id'];
		$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
		$dbconn = pg_connect($conn_string);
		$query_1 = "Select sender_id, sent_msg,date_trunc('minute' , time_stamp) as time from personal_messages where (sender_id = ".$sender_id." and receiver_id= ".$receiver_id.") or (receiver_id =".$sender_id." and sender_id =".$receiver_id.") order by time_stamp DESC";
		$result_1 = pg_query($dbconn,$query_1);
		while($arr = pg_fetch_array($result_1, NULL, PGSQL_ASSOC)){
			if($user_id == $arr["sender_id"]){
				echo "
			<div id=\"chat_data\" style=\"text-align:right\"> 
				<span style=\"color:blue;\">".$arr["sent_msg"]."</span><br>
				<font size=\"1\"><span style=\"color:grey;\">".$arr["time"]."</span></font>
			</div>";}
			else{
				echo "
			<div id=\"chat_data\" style=\"text-align:left\">  
				<span style=\"color:brown;\">".$arr["sent_msg"]."</span><br>
				<font size=\"1\"><span style=\"color:grey;\">".$arr["time"]."</span></font>
			</div>";
			}
		}
		$result = pg_query($dbconn,"update personal_messages set seen=1 where receiver_id='{$user_id}'");

?>
</div></body>