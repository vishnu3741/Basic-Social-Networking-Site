<html>
<style type="text/css">
h1 {
  font-weight: bold;
  color: "Black";
  font-size: 40px;
}
.top-centere {
    position: absolute;
    top: 60px;
    right: 700px;
    color: red;
}
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 70%;
    margin-left: auto;
    margin-right:auto;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #8E44AD;
    color: white;
}
body { margin-top: 5%; margin-right: 10%; margin-left: 10%;
  background-image: url("2.jpg");
  background-size: 100%;
background-attachment:fixed; }
</style>
    <body>
      <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      </head>
<?php



$dbconn = pg_connect("host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty");
$query = "select * from accounts";
$result =pg_query($query);
$num = pg_numrows($result);


?>
<a href="adminpage.html" class="btn btn-success" style="font-family:Comic Sans MS;text-decoration : none; width:120px;">Admin Home</a>
  <div class="top-centere"><font size="60" color ="BLACK" style="font-family:Comic Sans MS;"><b>Users List</b></font></div><br><br>

<table id= "customers" >

<tr>
<br><br><br><br><br><br>
<th><font face="Arial, Helvetica, sans-serif">ID</font></th>
<th><font face="Arial, Helvetica, sans-serif">Email</font></th>
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Password</font></th>
<th><font face="Arial, Helvetica, sans-serif">BanTime</font></th>
</tr>


<?php
$i = 0;

while ($i < $num)

    {

    $ID=pg_result($result,$i,"ID");
    $Email=pg_result($result,$i,"Email");
    $Name=pg_result($result,$i,"Name");
    $Password=pg_result($result,$i,"Password");
    $BanTime=pg_result($result,$i,"BanTime");

    ?>

<tr>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $ID; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $Email; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $Name; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $Password; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $BanTime; ?></font></td>

</tr>
<?php
$i++;

}

?>
</table>
<br><br>
</body>
</html>
