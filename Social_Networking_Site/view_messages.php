<?php 	
		session_start();
		$user_id = $_SESSION["id"];
		$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
		$dbconn = pg_connect($conn_string);
		$query_1 = "Select accounts.name as name, personal_messages.sent_msg as message from accounts, personal_messages where (receiver_id =".$user_id." and sender_id = accounts.id) and seen=0 order by time_stamp DESC";
		$result_1 = pg_query($dbconn,$query_1);
		
		$response = '';
		while($arr = pg_fetch_array($result_1, NULL, PGSQL_ASSOC)) {
			$response = $response . "<div class='notification-item'>".
			"<div class='notification-subject'>".$arr["name"]."</div>".
			"<div class='notification-comment'>".$arr["message"]."</div>".
			"</div>";
		}
		echo $response;
?>
