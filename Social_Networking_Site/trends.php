<?php     session_start(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./notification-demo-style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link rel="stylesheet" href="./navbar.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<style>
body {
  font-family:'Open Sans';
  background:#00FFFF;
}
input[type="submit"]{     
	width: 30%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer; }
input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function myFunction() {
		$.ajax({
			url: "./view_messages.php",
			type: "POST",
			processData:false,
			success: function(data){
				$("#notification-count").remove();					
				$("#notification-latest").show();$("#notification-latest").html(data);
			},
			error: function(){}           
		});
	 }
	 
	 $(document).ready(function() {
		$('body').click(function(e){
			if ( e.target.id != 'notification-icon'){
				$("#notification-latest").hide();
			}
		});
	});
</script>
</head>
<body>
<div class="sidenav">
      <form class="example" action="./live_search.php" method="post">
        <input type="text" name="string" placeholder="Search for people..."/>
		<button type="submit" value="submit" ><i class="fa fa-search"></i></button></form>
		<a href="./home.php" class="button">Home</a><br>
    <a href="./scroll.php" class="button">Feed</a><br>
    <a href="./add_post.php" class="button" rel="modal:open">Post to feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
	<a href="./followed_people.php" class="button" rel="modal:open">Chat</a><br>
	<a href="./logout.php" class="button">Logout</a>
    </div>
    
     <div class="demo-content">
		<div id="notification-header">
			<div style="position:relative">
			   <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count">
			   <?php
					$user_id=$_SESSION["user_name"];
					$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
					$dbconn = pg_connect($conn_string);
					$query_3="SELECT id from accounts where name='".$user_id."'";
					$result_3 = pg_query($dbconn,$query_3);
					while($arr_2 = pg_fetch_array($result_3, NULL, PGSQL_ASSOC)){
						$_SESSION["id"] = $arr_2["id"];
					}
					$query_2="SELECT * FROM personal_messages WHERE receiver_id=".$_SESSION["id"]." and seen = 0";
					$result_2 = pg_query($dbconn,$query_2);
					$count = 0;
					while($arr_1 = pg_fetch_array($result_2, NULL, PGSQL_ASSOC)){
						$count = $count+1;
					}
					echo $count;
				?>			   
			   </span><img src="./notification-icon_1.png" width="30" height="30" /></button>
				 <div id="notification-latest">
				 </div>
			</div>			
		</div>
	</div>
	
	<br><br><br>
    
    <div class="content">
<?php
  $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  $dbconn = pg_connect($conn_string);
  echo "<h1> Trending Topics(tags):</h1><br>";
  $word_count = array();
  $result = pg_query($dbconn,"SELECT unnest(tags) as tag FROM feed_messages WHERE time_stamp > CURRENT_TIMESTAMP - INTERVAL '20 days'");
  while($arr = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
        //echo $arr["tag"];
        if(array_key_exists($arr["tag"], $word_count)){
            $word_count[$arr["tag"]]++;
        }
        else{
            $word_count += array($arr["tag"] => 1);
        }
        //echo " count ".$word_count[$arr["tag"]]."<br>";
  }
  arsort($word_count, 1);
  //echo "sorted trends<br>";
  foreach ($word_count as $tag => $value) {
      echo "<form action=\"./trend_analysis.php\" method=\"post\">";
      echo "#<input type=\"hidden\" name=\"tag\" value=".$tag." >".$tag." ".$value." posts ";
      echo  "<input type=\"submit\" value=\"see related posts\" name=\"see related posts\"><br></form>";
  }
?>
</div>

</body>
</html>
