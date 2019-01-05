<?php
$db = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$query = "insert into request values('$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[description]')";
$result = pg_query($query);
if($result){
    echo "<script>alert('Admin will see to your request.');
                window.location.href='index1.html';
                </script>";
    exit();
}

?>
