<?php     session_start(); ?>
<!doctype html>
<html> 
<head> 
</head>
<style>
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
select{ 
    background-color: orange; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
select:hover {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}

h1
{
	text-align:center;
	font-size:35px;
	margin-top:50px;
	color:#0B173B;
}
</style>
<?php 	
        $follower_id = $_SESSION["user_id"];
		$conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
		$dbconn = pg_connect($conn_string);
		$query_1 = "select accounts.name as t, accounts.id as y from accounts, following where following.followed_by =".$follower_id." and following.follower_of = accounts.id";
        $result_1 = pg_query($dbconn,$query_1);
        echo "<h1>Chat with:</h1>";
		echo "<form action=\"./message_form.php\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"sender_id\" value=\"".$follower_id."\"></intput>";
		echo "<select name=\"receiver_id\">";
		while($arr = pg_fetch_array($result_1, NULL, PGSQL_ASSOC)){
			echo "<option value=\"".$arr['y']."\">".$arr['t']."</option>";
		}
		echo "</select>";
		//echo "<br><br>";
		echo "<input type=\"submit\" value=\"Submit\">";
		echo "</form>";
        ?>
</head>
</html>
