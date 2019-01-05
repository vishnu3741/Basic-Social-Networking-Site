<?php
$db = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$query = "update accounts set bantime = now()+ interval '$_POST[time] days'
 where id= '$_POST[id]' and name='$_POST[name]' ";
$result = pg_query($query);
if($result){
  echo "User $_POST[name] is temporarily banned for $_POST[time] days !";
    echo "<script>alert('User Banned successfully.');
                window.location.href='banuser.html';
                </script>";
    exit();
}
echo "User $_POST[name] is temporarily banned for $_POST[time] days !";
?>
