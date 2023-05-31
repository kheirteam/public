<?php
include('../../db/db.php');
include('../../routes.php');
include('class/alert.php');
include('../../array_amana.php');


$_name = $_POST['name'];
$_id_num = $_POST['id_num'];
$_gender = $_POST['gender'];
$_nationality = $_POST['nationality'];
$_job = $_POST['job'];
$_hcn = $_POST['hcn'];
$_date_htc = $_POST['date_htc'];
$_date_ehtc = $_POST['date_ehtc'];
$_amana = $_POST['amana'];
$_balady = $baldya_array[array_search($_amana, $amana_array)];
$_tcp = $_POST['tcp'];
$_tcp_date = $_POST['tcp_date'];
$_redio = $_POST['c'];
$_title = $_POST['title'];
$char = "abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$token = substr(str_shuffle($char), 0, 35);
//check 
if (empty($_name)) {
    return errorLog('Enter name');
}
if (empty($_id_num)) {
    return errorLog('Enter id number');
}



$check_user = mysqli_query($db, "SELECT * FROM `contact` WHERE `ID_Number`='$_id_num' OR `uid`='$token' LIMIT 1");
$check = mysqli_fetch_assoc($check_user);

if ($check) {
    if ($check['uid'] === $token) {
        $token = substr(str_shuffle($chars), 0, 13);
        mysqli_query($db, "UPDATE `contact` SET `uid`='$token' WHERE `ID_Number`='$_id_num'");
    } else if ($check['ID_Number'] === $_id_num) {
        return warningLog("Enter another ID Number.");
    }
} else {
    // File upload path
    $targetDir = '../../../images/users/';
    $fileName = basename($_FILES["file"]["name"]);
    if (empty($fileName)) {
        return warningLog("Enter Image.");
    }
    $newfileName = '' . $token . '_' . $_id_num . '_' . $fileName . '';
    $targetFilePath = $targetDir . $newfileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg');

    if (!in_array($fileType, $allowTypes)) {
        return 'jpg ,png, jpeg';
    }

    // Upload file to server
    if ($_FILES["file"]["size"] >= 2500000) {
        return 'Sorry, max img 2mb.';
    }

    $move = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
    if (!$move) {
        return errorLog('Upload Error');
    }
    $newKay = array_search($_amana, $amana_array);
    $send_data = mysqli_query($db, "INSERT INTO `contact`(`uid`, `name`, `ID_Number`, `gender`, `nationality`, `balady`, `amana`, `HCN`, `job`, `date_IHC`, `date_EHC`, `TCP`, `EDCP`, `img`,`date_up`,`card`,`amana_get`,`title_hc`) VALUES ('$token','$_name','$_id_num','$_gender','$_nationality','$_balady','$_amana','$_hcn','$_job','$_date_htc','$_date_ehtc','$_tcp','$_tcp_date','$newfileName','$date ','$_redio','$newKay','$_title')");
    if ($send_data) {
        $get_id = mysqli_query($db, "SELECT `id` From `contact` WHERE `uid` = '$token'");
        $show_id = mysqli_fetch_assoc($get_id);
        $url_id = $show_id['id'];
        $url = $printCard . '?id=' . $url_id . '';
        echo "<script>window.open('$url', '_blank');</script>";

    } else {
        return errorLog('error');
    }


}