<?php
    $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
    $dbconn = pg_connect($conn_string);
    session_start();
    if(isset($_POST["tags"])){
        $tags = $_POST["tags"];
        $user = $_SESSION["user_id"];
        $msg = $_POST["message"]; 

		$file = $_FILES['upload'];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
		
		$file_ext = explode('.',$file_name);
		$file_ext = strtolower(end($file_ext));
		$allowed = array('jpg','png');
		
		if($file_name == ''){
			$result = pg_query($dbconn,"INSERT INTO feed_messages (sender_id,post,tags) VALUES ('{$user}','{$msg}','{{$tags}}')");
			echo "<script>alert('posted successfully');
				window.location.href='scroll.php';</script>";
		}
		else{
			if(in_array($file_ext, $allowed)){
				if($file_error == 0){
					if($file_size <= 10485760){
						$file_name_new = uniqid('',true).".".$file_ext;
						$file_destination = "uploads/".$file_name_new;
						if(move_uploaded_file($file_tmp, $file_destination) === 0){
							echo "<script type='text/javascript'>alert('Problem uploading file');</script>";
						}
						else{
							$result = pg_query($dbconn,"INSERT INTO feed_messages (sender_id,post,tags,location) VALUES ('{$user}','{$msg}','{{$tags}}','{$file_destination}')");
							echo "<script>alert('posted successfully');
									window.location.href='scroll.php';</script>";
						}
					}
					else{
						echo "<script type='text/javascript'>alert('File size too much');</script>";
					}
				}
				else{
					echo "<script type='text/javascript'>alert('Something wrong with the file');</script>";
				}
			}
		else{
			echo "<script type='text/javascript'>alert('Only jpg or png allowed');</script>";
		}
	}
  }
   
?>
