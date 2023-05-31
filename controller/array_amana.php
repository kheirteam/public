<?php

include('db/db.php');
$amana_array =array();
$baldya_array = array();
$get_data= mysqli_query($db,"SELECT  * FROM amana");
while( $row = mysqli_fetch_assoc($get_data)){
    $amana_array[] = $row['amana'];
    $baldya_array[] = $row['balady'];
}
