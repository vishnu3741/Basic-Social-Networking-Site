<?php
$db = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$query = " update accounts set password = '$_POST[passwd]' where email= '$_POST[id]' and password='$_POST[oldpass]'";
$result = pg_query($query);
if($result){
  echo "  <script>alert('Password Updated !');
          window.location.href='index1.html';
          </script>";
      }
else {

          echo "  <script>alert('Wrong Credentials, Password Could Not be Updated.');
                  window.location.href='index1.html';
                  </script>";

}
?>
