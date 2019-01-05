<?php
  $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  $dbconn = pg_connect($conn_string);
 // echo $_SESSION["user_name"]." user name<br>";
 session_start();
  $val = $_POST["getresult"];
  $tag = $_SESSION["tag"];
  //echo $tag." tag";
  $result = pg_query($dbconn, "SELECT post,time_stamp,sender_id,accounts.name,feed_messages.location as location1,accounts.location as location2 FROM feed_messages,accounts WHERE tags @> '{{$tag}}' and accounts.id = feed_messages.sender_id ORDER BY time_stamp DESC LIMIT 20 OFFSET '{$val}'");
  while($feed = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
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
  echo "</div>
		</div>";
  }
?>