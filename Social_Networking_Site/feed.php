<?php session_start(); ?>
<html>
<body>
<?php
  $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  $dbconn = pg_connect($conn_string);
  $val = $_POST["getresult"];
  $insert_values = $_SESSION["user_id"];
  $innner_result = pg_query($dbconn,"SELECT post,time_stamp,sender_id,name, feed_messages.location as location1, accounts.location as location2 FROM feed_messages,accounts where (sender_id in (SELECT follower_of FROM following where followed_by='{$insert_values}') or sender_id in ('{$insert_values}')) and sender_id=accounts.id ORDER by time_stamp DESC LIMIT 10 OFFSET '{$val}'");
  while($feed = pg_fetch_array($innner_result,NULL, PGSQL_ASSOC)){
		$splitTimeStamp = explode(" ",$feed["time_stamp"]);
		$date = $splitTimeStamp[0];
		echo "<div id=\"main-window\">
		<div class=\"post\">
		<div class=\"user\">";
		if($feed['location2'] != ''){
			echo "<div class=\"user-img\"><img src= '".$feed['location2']."' width=\"100%\" height=\"100%\" alt=\"post-image\"/></div>";
		}
		echo "<div class=\"user-info\">
        <div class=\"user-name\">".$feed["name"]."</div>
        <span class=\"post-date\">".$date."</span>
		</div>
		</div>
		<div class=\"content\">".$feed["post"]."
		</div>";
		if($feed['location1'] != ''){
			echo "<div class=\"media photo\"><img src= '".$feed['location1']."' alt=\"post-image\"/></div>";
		}
		echo "</div></div>";
  }
  pg_close($dbconn);
?>
</body>
</html>
