<?php
require_once('../../../db/db.php');

$countries = array();
$query = "SELECT name FROM countries";
$result = mysqli_query($db, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $countries[] = $row['name'];
    }
    mysqli_free_result($result);
}

echo json_encode($countries);
