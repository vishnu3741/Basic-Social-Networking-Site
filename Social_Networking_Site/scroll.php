<?php     session_start(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./notification-demo-style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script type="text/javascript">
	 var $post = $('#main-window').html();
	 var posts = '';
    for(var i=0;i<20;i++){
		posts += $post;
	}
$('#main-window').html(posts);
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
      url: 'feed.php',
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
<style>
.content {
	height:auto;
    margin-left: 300px;
	padding-left: 20px;
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
h1
{
	text-align:center;
	font-size:35px;
	margin-top:50px;
	color:#0B173B;
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
  top:80px;
  left:0;
  right:0;
  max-width:650px;
  width:95%;
  padding:0px 0;
  /* background:#fff; */
}

/*

  User Posts
   - User Details
   - Share Icons
   - Content
   - Media

*/

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
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}

.post .user {
  padding:10px;
  background:#f9f9f9;
  overflow:hidden;
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
.post .user .actions {
  float:right;
}
.post .user .actions span {
  margin-right:10px;
  width:35px;
  height:35px;
  float:left;
  display:block;
  cursor:pointer;
  overflow:hidden;
  background-size:80%;
  background-position:50% 50%;
  background-repeat:no-repeat;
  opacity:0.2;
  transition:0.25s opacity ease-in-out;
}
.post .user .actions span:hover {
  opacity:1;
}
.post .user .actions span:last-child{
  margin-right:0;
}
.post .user .actions span.heart {
  background-image:
url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACAUlEQVRYR82XjU0DMQxGv04ATAAbQCeATkA7ATABsAEbABMAEwATABNAJ6BsUCYAvZNducf9JHcnlUioIrHzvdiOoxtpw2O0YX3VAZxIOrK/PYP8kPQq6dl+q9jxOTa/AzNYmP2T+a75lQFwupPkznUBYrMzSUsz2Da/aUtEOcClJA5TjAhwKulaEpv5+A7GQG2FNU42s/8fJXmkmGryAxo/YFYAbP4SxN8kXVWEGkjmd004RoCpL1u/L0WC1OB3GPwmHM4jgDhGjAdJCNUNIgT9fslgbns4VJU/YNQXgz0mACBG3hmc3EEaGIo0RYgUcd8PP4/EDIBIRViK3CQMIG7M7iIUZJsrByTiRbQB+LQConBiAbZt1GedNFHQCwB+MsPfR/hPGv4FAE2BiiYsO0McL2EPj/qcCFBI5+ZEdyvf4YT9skzirbsFIFYl3W2cUdFZylbk76Frjr0R0dt5RBikhOvY1FByhbHnhnH9/J3hUZs6AIsIe4sdGqIsTssGZBkfIyZoQv7gDAVRFqffkPbiRax6joeEaBSvAmBuqEi0itcBDAGRJN4E0AciWbwNoAtElngKQA5EtngqQApEJ/EcgCYI1mKHW7vnbS0z98Ok6oo6HL9Z4rkR8MOUIXw+W7wrQFU6Oon3AXAIXlEGX0Srr522vMf13BrI2TvJduMAv9o2lX4LR6fmAAAAAElFTkSuQmCC');
}
.post .user .actions span.comment {
  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABIElEQVRYR+2X0bEBQRBFjwgQARkgAkKQASJQIkAGRIAMhEAGRPCeDGRAXTVTtTW1ip4dy8f2z+58TN9z7/ZHb40vVw1oAHNg7N7LQLoCW2AmgBUwLUM1R2MtANHUgSMwdOdP8ijxPdAH/gVwc2rNEsS9sTbwp0MWQO9l1sN4BfDTCZyATqKhUK9e0OvlDKQEOANdK0Ai80/bvEygAvi5BCxDmTf1oSHzDFgA8qa+MEDqT2JOoAKoEvh4Al9byfxSegAmWhRTWw36aR/cAAPgooVk4f4LLLoC1V6fLf1XqLGlln4RFYQatAy3sxBW8YszsIjZhOV85EAFofLOd87I2z5iANQ8C+HFzOK6GAsQQkSJFwXwEHpqBqKqSAJRguGlOwYCUNzXkk7/AAAAAElFTkSuQmCC');
}
.post .user .actions span.share {
  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAB6ElEQVRYR82XgTEEQRBF/0WACBABGSADIkAEiIAMEAEi4CJABkTgZEAG6l1Nq941s9d7s1unq1Sp2pnu37+7//RNNJ6dSDqTtJtCPEm6lfTiQ05GiL8u6VHSfsH3vaRT+zYGgJuUeVduR5JgREMD2JL0EWB1Jml7DADU/S4AgCMAmA3NwJWkyyCAAxpySADQT/NZ1y/CsSHpawgAdD3jRvZRe7UpqQVwKOlaEtlH7TsFf6tpQgLSbKVZn6Zvay1UBAf0rxiVGIDWnXT5nVql/xfRzdnzFICzTIWxQ8bMvvmau2wD4BKUctEbF/mjzjm6yYxviFAv8wAI/tyjiy3QQ8q6kVkUhQcQkVDv19MdjffnnAdABu2myTlemu6cMwNAN0N/xC6WqXXJ8b8BAMBoCThHx7NcVFtNEzLXlKOx4fRF1B5DnJkARX2x4QCkegwJiBYwjset6EirCdFmBtnSZemSYntWodpLMVJbevN9WUiGRLwUk0inFEdpxynU7xUuwBajDQhvBGcfXPgYRYHwslGyXFlKPgDBNlT1HHvnZNlVlhwQGADEoFsxZYH66BQNtpL5DFe6lAJk5Wt59IfJp41n7VKaa7DIXjHaTzNTU5qxpBE8YkzN3MZgwHzTDwSyqUAFYafxeP0AlftgIScjdPAAAAAASUVORK5CYII=');
}
.post .content {
  padding:20px;
  font-size:16px;
  line-height:22px;
  font-family:'Helvetica Neue';
  overflow:hidden;
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
    <a href="./add_post.php" class="button" rel="modal:open">Post to feed</a><br>
    <a href="./personal_msg.php" class="button">Personal Messages</a><br>
    <a href="./trends.php" class="button">Trends</a><br>
    <a href="./followed_people.php" class="button" rel="modal:open">Chat</a><br>
    <a href="./logout.php" class="button">Logout</a>
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
			   </span><img src="notification-icon_1.png" width="30" height="30" /></button>
				 <div id="notification-latest">
				 </div>
			</div>			
		</div>
	</div>
  <?php
    $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
    $dbconn = pg_connect($conn_string);
    $insert_values = $_SESSION["user_id"];
    $innner_result = pg_query($dbconn,"SELECT post, time_stamp, sender_id, feed_messages.location as location1, name, accounts.location as location2 FROM feed_messages,accounts where (sender_id in (SELECT follower_of FROM following where followed_by='{$insert_values}') or sender_id in ('{$insert_values}')) and sender_id=accounts.id ORDER by time_stamp DESC LIMIT 10");
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
  </div>
  <input type="hidden" id="row_no" value="10">
</body>
</html>
