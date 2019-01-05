


<?php
    $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
    $dbconn = pg_connect($conn_string);
    $email = $_POST["email"];
    $password = $_POST["password"];
    session_start();
    if(empty($_POST["name"])){
        echo "login \n";
        $date = date('Y-m-d H:i:s');
        $newresult = pg_query($dbconn,"SELECT  bantime from accounts where email='$email'");
        $data = pg_fetch_result($newresult, 0, 0);
        $result = pg_query_params($dbconn,"SELECT id,name,password from accounts where email=$1",array($email)); 
        if($result == FALSE){
            echo "email invalid account not created";
        }
        else{
			if ($date < $data) {
                echo "  <script>alert('User is Temporarily banned');
                        window.location.href='index1.html';
                        </script>";
              }
              else{
            $arr = pg_fetch_array($result, 0, PGSQL_ASSOC);
            if($arr["password"]==$password){
                $_SESSION["user_name"] = $arr["name"];
                $_SESSION["user_id"] = $arr["id"];
                $_SESSION["password"] = $arr["password"];
                echo "<script>
                        window.location.href='home.php';
                        </script>";
                exit();
            }
            else{
                echo "<script>alert('incorrect password or username');
                        window.location.href='index1.html';
                        </script>";
                exit();
            }
        }}
    }
    else{
        echo "signup \n";
        $name = $_POST["name"];
        $arr=array($email, $name, $password);
        
        $file = $_FILES["photo"];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
        $result1 = pg_query_params($dbconn,"SELECT email from accounts where email=$1",array($email));
        $arr3 = pg_fetch_array($result1,NULL,PGSQL_ASSOC);
        if($arr3["email"]== $email){
            echo "<script>alert('Account with this email exits:')
            window.location.href='loginform.html';
            </script>";
        } 
        else{
        echo "<script>alert('Account created successfully:'".$file_name.")</script>";
		
		$file_ext = explode('.',$file_name);
		$file_ext = strtolower(end($file_ext));
		$allowed = array('jpg','png');
		
		if($file_name == ''){
			$result = pg_query_params($dbconn,"INSERT INTO accounts (email , name , password) VALUES ($1, $2, $3)",$arr);
			echo "<script>alert('Account successfully created');
				window.location.href='index1.html';</script>";
		}
		else{
			if(in_array($file_ext, $allowed)){
				if($file_error === 0){
					if($file_size <= 10485760){
						$file_name_new = uniqid('',true).".".$file_ext;
						$file_destination = "uploads/".$file_name_new;
						if(move_uploaded_file($file_tmp, $file_destination) === 0){
							echo "<script type='text/javascript'>alert('Problem uploading file');</script>";
						}
						else{
							$result = pg_query($dbconn,"INSERT INTO accounts (email,name,password,location) VALUES ('{$email}','{$name}','{$password}','{$file_destination}')");
							echo "<script>alert('Account Created Succesfully');
									window.location.href='index1.html';</script>";
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
    }
    pg_close($dbconn);
?>
