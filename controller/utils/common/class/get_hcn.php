<?php
require_once('../../../db/db.php');

$query = "SELECT HCN FROM contact WHERE id = (SELECT MAX(id) FROM contact)";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hcn_data = $row['HCN'];
} else {
    $hcn_data = '';
}

echo $hcn_data;
