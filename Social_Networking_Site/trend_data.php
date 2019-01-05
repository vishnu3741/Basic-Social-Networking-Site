<?php
    $conn_string = "host=localhost port=5432 dbname=messagingapp user=user3 password=123qwerty";
    $dbconn = pg_connect($conn_string);
    session_start();
    $tag  = $_SESSION["tag"];
    $result = pg_query($dbconn, "SELECT time_stamp::date,count(post) AS posts FROM feed_messages where tags@> '{{$tag}}' group by time_stamp::date");
    $rows = array();
    $table = array();
    $table['cols'] = array(
        array('label'=>'date','type'=>'string'),
        array('label'=>'number of posts','type'=>'number')
    );
    while($r = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
        $temp = array();
        $temp[] = array('v' => (string) $r["time_stamp"]);
        $temp[] = array('v' => (int) $r["posts"]);
        $rows[] = array('c' => $temp);
    }
    $table['rows'] = $rows;
    echo json_encode($table);
?>