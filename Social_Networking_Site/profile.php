<?php   session_start(); ?>
<html>
  <head>
  <link rel="stylesheet" href="./notification-demo-style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link rel="stylesheet" href="./navbar.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
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
    <style>
h1
{
	text-align:center;
	font-size:35px;
	
	color:brown;
}
h3
{
	text-align:right;
	font-size:20px;
	margin-top:50px;
	color:red;
}
.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

/* Louis' Styles */

body {
  font-family:'Open Sans';
  background:#00FFFF;
}
.profile,
.new-post{
  position:absolute;
  margin:auto;
  top:0;
  left:0;
  right:600px;
  bottom:0;
  width:50px;
  height:50px;
  border-radius:6px;
  background:rgba(0,0,0,0.05);
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  cursor:pointer;
  background:url(https://s3.amazonaws.com/uifaces/faces/twitter/felipebsb/128.jpg) 50% 50% / cover no-repeat;
  box-sizing:border-box;
}
.new-post{
  left:600px;
  right:0;
  max-width:100px;
  max-height:64px;
  background:rgba(0,0,0,0.4);
  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACHElEQVR4XuXb/03DMBCG4e82YARGKBNQJqGdADERZQOYANiAbsAGlAkOuWoqQpv6153js/NvE6nvg+3EAQiNHMz8AGAFYAHgBcAjEX358sh3goXPmfnpEP/36+4A3BHR56UG8wAT8UOzF8E0gCc+CMEsQGC8F8EkQGT8RQRzAInxkwimAJjZ3ebcip9zjBZGUwCumpk3AO5zBAAcEcwBCCPcmAQQRHitFuAw32+JaD013AWmw65KgH+L3UYRYVsdwMRKr4XwWBWA5zYnjfBMRKtqAALv8VIIWyJy22ZUARAYP6yFuQhbAEsics8C8wNExuci/AC4HuJnB0iMT0Vw8e4nP3pBMtsUyIyPRTgbP9sIEIqPQXgnIreHODmKjwDh+CCEat4JKsVnIRQbAcrxyQhFAJh5CeAtcw8fevl6ar7PsgYws3vicvFXoQUZ5+0fb2OuVx0Btcer3gYtxKsBWIlXAbAULw5gLV4UwGK8GIDVeBEAy/HZANbjswAKx38QkXucFj+SngQLx4/e4UkLRAO0FB89BVqLjwJoMT4YoNX4IICW470ArcdfBOghfhKgl/izAD3FnwD0Fj8C6DH+CNBr/B6g5/gB4LvQLy1Ud3Wpu0Q3Ajj14ojrqowfRoA2QLXxJQCqjtcGqD5eE8BEvBaAmXgNAFPx0gDm4iUBTMZLAZiNlwAwHZ8LYD4+B8D97e0i5N/TI/YLs5z6C9XImUBvMbYLAAAAAElFTkSuQmCC');
  background-position:50% 50%;
  background-repeat:no-repeat;
  background-size:60%;
}
#sub-menu {
  position:fixed;
  margin:auto;
  top:90px;
  left:0;
  right:0;
  bottom:10px;
  max-width:950px;
  display:none;
}
#left-bar,
#right-bar{
  width:170px;
  height:100%;
  float:left;
  background:rgba(255,255,255,0.1);
}
#right-bar {
  float:right;
}

#main-window {
  position:relative;
  margin:auto;
  top:0px;
  left:0;
  right:0;
  max-width:650px;
  width:95%;
  /* background:#fff; */
}

.post {
  margin:20px auto 20px;
  width:100%;
  background:#fff;
  border-radius:4px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.2s ease-in-out;
  overflow:hidden;
}

.post:hover {
  box-shadow: 0 0px 0px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}

.post .user {
  padding:10px;
  background:#f9f9f9;
  overflow:hidden;
}
.wrapper{
  padding:50px;
}

.image--cover{
  width:150px;
  height:150px;
  border-radius:50%;
  margin:20px;
  object-fit:cover;
  object-position:center right;
}
.post .user .user-info {
  margin-right:10px;
  width:calc(100% - 190px);
  height:35px;
  line-height:18px;
  float:left;
  color:#98d;
}
.post .user .user-info .post-date {
  font-size:13px;
  color:#444;
}

.post .user .user-img {
  margin-right:10px;
  width:35px;
  height:35px;
  float:left;
  border-radius:6px;
  background:#444;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  overflow:hidden;
}

.post .content {
  padding:15px;
  font-size:16px;
  line-height:22px;
  font-family:'Helvetica Neue';
  overflow:hidden;
}
input[type=submit] {
  background-color: #0693cd;
  border: 0;
  border-radius: 5px;
  cursor: pointer;
  color: #fff;
  font-size:16px;
  font-weight: bold;
  line-height: 1.4;
  padding: 10px;
  width: 180px
}
.post .media{
  margin:0 20px 20px;
}
.post .media img {
  border-radius:4px;
  width:100%;
}
.post .media iframe {
  border-radius:4px;
}
</style>
  </head>
<body>
<div class="sidenav">
    <form class="example" action="./live_search.php" method="post">
    <input type="text" name="string" placeholder="Search for people..."/>
    <button type="submit" value="submit" ><i class="fa fa-search"></i></button></form>
    <a href="./home.php" class="button">Home</a><br>
    <a href="./scroll.php" class="button">Feed</a><br>
    <a href="./add_post.html" class="button" rel="modal:open">Post to feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
    <a href="./followed_people.php" class="button" rel="modal:open">Chat</a><br>
    <a href="./logout.php" class="button">Logout</a>
</div>
<div class="content">
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
  </div><br>

<?php
  $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  $dbconn = pg_connect($conn_string);
  $userid = $_SESSION["user_id"];
  $profilename = $_POST["name"];
  $mail = $_POST["mail"];
  if(isset($_POST["id2"])){
    $id2 = $_POST["id2"];
    $fid = $_SESSION["user_id"];
    $result = pg_query($dbconn,"INSERT into following VALUES ({$fid},{$id2})");
  }
  else if(isset($_POST["id1"])){
    $id1 = $_POST["id1"];
    $result = pg_query($dbconn,"DELETE from following where follower_of={$id1}");
  }
    
  $innner_result = pg_query($dbconn,"SELECT id,location from accounts where email='{$mail}'");
  $arr= pg_fetch_array($innner_result ,NULL ,PGSQL_ASSOC);
  $id = $arr["id"];
  if($arr['location']!=''){
    echo "<div class=\"wrapper\">";
  echo "<img src= '".$arr['location']."' width=\"100%\" height=\"100%\" alt=\"post-image\" class=\"image--cover\"/>";}
  echo "<h1>Profile page of ".$profilename."</h1>";
  echo "<h3>email:".$mail."</h3>";
  echo "<br></div>";
  $result = pg_query($dbconn, "SELECT count(followed_by) from following where follower_of={$id}");
  $arr = pg_fetch_array($result,NULL,PGSQL_ASSOC);
  echo "<h4>".$arr["count"]." followers ";
  $result = pg_query($dbconn, "SELECT count(follower_of) from following where followed_by={$id}");
  $arr = pg_fetch_array($result,NULL,PGSQL_ASSOC);
  echo " ".$arr["count"]." following</h4>";
  $result1 = pg_query($dbconn,"SELECT follower_of from following where followed_by='{$userid}'");
  $following=0;
  while($arr2=pg_fetch_array($result1,NULL,PGSQL_ASSOC)){
        if($arr2["follower_of"]==$id){
            $following = 1;
        }
  }
  if($following==1){?>
      <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">
      <input type="hidden" name="id1" value=<?php echo $id;?>>
      <input type="hidden" name="name" value=<?php echo $profilename;?>>
    <input type="hidden" name="mail" value=<?php echo $mail;?>>
      <input type="submit" value="following"></form><br>
  <?php }
  elseif($following==0){?>
    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">
    <input type="hidden" name="id2" value=<?php echo $id;?>>
    <input type="hidden" name="name" value=<?php echo $profilename;?>>
    <input type="hidden" name="mail" value=<?php echo $mail;?>>
    <input type="submit" value="follow"></form><br>
    <?php }

echo "<h1>Posts by ".$profilename.":</h1>";
  $insert_values = $id;
  $innner_result = pg_query($dbconn,"SELECT post, time_stamp, sender_id, feed_messages.location as location1, name, accounts.location as location2 FROM feed_messages,accounts where sender_id ='{$insert_values}' and sender_id=accounts.id ORDER by time_stamp DESC LIMIT 10");
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
  echo "</div>";
  pg_close($dbconn);
?>
</body>
</html>
