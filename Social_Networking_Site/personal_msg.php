<?php     session_start(); ?>
<!DOCTYPE html>
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
  padding:100px;
	text-align:center;
	font-size:35px;
	margin-top:50px;
	color:#0B173B;
}
</style>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">   
    $(window).scroll(function ()
    {
	  if($(document).height() <= $(window).scrollTop() + $(window).height())
	  {
		loadmore();
	  }
    });

    function loadmore()
    {
      var val = document.getElementById("row_no").value;
      $.ajax({
      type: 'post',
      url: './personal_msg_scroll.php',
      data: {
       getresult:val
      },
      success: function (response) {
	  var content = document.getElementById("all_rows");
      content.innerHTML = content.innerHTML+response;

      // We increase the value by 10 because we limit the results by 10
      document.getElementById("row_no").value = Number(val)+10;
      }
      });
    }
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
	<a href="logout.php" class="button">Logout</a>
    </div>
		<div id="all_rows" class="content">
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
	  <h1>Load personal messages From Database </h1>
		<?php
  	$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
  	$dbconn = pg_connect($conn_string);
 		// echo " from session ".$_SESSION["user_name"];
  		$id = $_SESSION["user_id"];
  		$innner_result = pg_query($dbconn,"SELECT sent_msg,time_stamp,sender_id FROM personal_messages where receiver_id='{$id}' ORDER by time_stamp DESC LIMIT 10"); 
			while($feed = pg_fetch_array($innner_result,NULL, PGSQL_ASSOC)){
        echo "<p>".$feed["sent_msg"]." posted by ".$feed["sender_id"]."<br></p>";
    	}
 	 	pg_close($dbconn);
		?> </div>
  <input type="hidden" id="row_no" value="10">
</body>
</html>
