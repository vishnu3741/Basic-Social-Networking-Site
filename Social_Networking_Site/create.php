<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$id=$_POST[id];
$password=$_POST[pwd];
$arr=array($id, $password);
$result = pg_query_params($dbconn,"INSERT INTO adminvalues ( id , password) VALUES ($1, $2)",$arr);
if($result){
    echo "<script>alert('Admin created successfully.');
                window.location.href='adminpage.html';
                </script>";
    exit();
}
?>
