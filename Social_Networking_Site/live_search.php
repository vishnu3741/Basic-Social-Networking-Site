<?php session_start(); ?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./navbar.css">
<link rel="stylesheet" href="./notification-demo-style.css" type="text/css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
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
.user-img {
  margin-right:10px;
  width:35px;
  height:35px;
  float:left;
  border-radius:6px;
  background:#444;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  overflow:hidden;
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
    <a href="./add_post.html" class="button">Post to feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
	<a href="./followed_people.php" class="button">Chat</a><br>
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
				 <div id="notification-latest"></div>
			</div>			
		</div>
	</div>
    
    <br><br>
	
<div class="content">
<?php
	$search = $_POST["string"];
	$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
	$dbconn = pg_connect($conn_string);
	$query_1 = "select name,email,location from accounts where name like ('%".$search."%')";
	$result_1 = pg_query($dbconn,$query_1);
	echo "<h1>Search Results:</h1>";
	while($arr = pg_fetch_array($result_1, NULL, PGSQL_ASSOC)){
		if($arr["name"]!=$_SESSION["user_name"]){
		echo "<form action=\"profile.php\" method=\"post\">";
		if($arr['location'] != ''){
			echo "<div class=\"user-img\"><img src= '".$arr['location']."' width=\"100%\" height=\"100%\" alt=\"post-image\"/></div>";
		}
		echo "<input type=\"submit\" name=\"name\" value=\"".$arr['name']."\" >";
		echo " Email:".$arr["email"];
		echo "<input type=\"hidden\" name=\"mail\" value=\"".$arr["email"]."\">";
		echo "<br>";
		echo "</form>";}
	}	
?>
</div></body>

