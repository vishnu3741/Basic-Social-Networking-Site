<?php
$db = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$query = "delete from accounts where id= '$_POST[id]' and name='$_POST[name]'";
$result = pg_query($query);
if($result){
    echo "<script>alert('User Gets Removed Successfully.');
                window.location.href='banuser.html';
                </script>";
    exit();
}

?>
