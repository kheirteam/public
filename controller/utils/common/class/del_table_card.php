<?php
require_once('../../../db/db.php');
require_once('../../../routes.php');
require_once('alert.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT img FROM contact WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $contact = mysqli_fetch_assoc($result);

    if ($contact) {
        $imgPath = $pathImagePage . $contact['img'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
        $query = "DELETE FROM contact WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $msg = warningLog('Contact deleted successfully.');
        echo $msg;
    } else {
        $msg = errorLog('Contact not found.');
        echo $msg;
    }
}