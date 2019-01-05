<?php
	session_start();
    $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
    $dbconn = pg_connect($conn_string);
    $name = $_POST["user"];
    $password = $_POST["password"];


        $result = pg_query_params($dbconn,"SELECT password from adminvalues where id =$1",array($name));

            $arr = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            if($arr["password"]==$password){

                echo "<script>
                       window.location.href='adminpage.html';
                        </script>";
                exit();
            }
            else{
                echo "<script>alert('incorrect password');
                        window.location.href='index1.html';
                       </script>";
                exit();
            }



    pg_close($dbconn);
?>
