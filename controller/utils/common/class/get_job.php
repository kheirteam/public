<?php
require_once('../../../db/db.php');

$job = array();
$query = "SELECT job FROM job";
$result = mysqli_query($db, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $job[] = $row['job'];
    }
    mysqli_free_result($result);
}

echo json_encode($job);
