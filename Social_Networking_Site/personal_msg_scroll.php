<?php
  $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  $dbconn = pg_connect($conn_string);
  session_start();
  echo " from session ".$_SESSION["user_name"];
  $val = $_POST["getresult"];
  $insert_values = array($_SESSION["user_id"]);
  $innner_result = pg_query_params($dbconn,"SELECT sent_msg,time_stamp,sender_id FROM personal_messages where receiver_id=$1 ORDER by time_stamp DESC LIMIT 10 OFFSET '{$val}'",$insert_values);
   while($feed = pg_fetch_array($innner_result,NULL, PGSQL_ASSOC)){
        echo "<p>".$feed["sent_msg"]." posted by ".$feed["sender_id"]."<br></p>";
    }
  pg_close($dbconn);
?>