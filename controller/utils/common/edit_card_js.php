<?php
include('../../db/db.php');
include('../../routes.php');
include('class/alert.php');
include('../../array_amana.php');

$id = $_POST['id'];
$_id_num = $_POST['id_num'];
$_name = $_POST['name'];
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
$old_img = $_POST['old_img'];

//check 
if (empty($_name)) {
    return errorLog('Enter name');
}
if (empty($_id_num)) {
    return errorLog('Enter id number');
}



$check_user = mysqli_query($db, "SELECT * FROM `contact` WHERE `id`='$id' ");
$check = mysqli_fetch_assoc($check_user);

if ($check) {
  
    
    // File upload path
$targetDir = '../../../images/users/';
$fileName = isset($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : null;

if (empty($fileName)) {
    $newfileName=$old_img;
}else{
    
$UID = isset($check['uid']) ? $check['uid'] : null;
$newfileName = $UID . '_' . $_id_num . '_' . $fileName;
$targetFilePath = $targetDir . $newfileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

// Allow certain file formats
$allowTypes = array('jpg', 'png', 'jpeg');

if (!in_array($fileType, $allowTypes)) {
    return warningLog("Enter Image -jpg ,png, jpeg.");
}

// Upload file to server
if ($_FILES["file"]["size"] >= 2500000) {
    return warningLog('Sorry, max img 2mb.');
}
$img = isset($check['img']) ? $check['img'] : null;

if ($img  != $newfileName) {
    $move = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
    if (!$move) {
        return errorLog('Upload Error');
    }
}
}


    $newKay = array_search($_amana, $amana_array);
$updateData=mysqli_query($db, "UPDATE `contact` SET `name`='$_name', `ID_Number`='$_id_num', `gender`='$_gender', `nationality`='$_nationality', `balady`='$_balady', `amana`='$_amana', `HCN`='$_hcn', `job`='$_job', `date_IHC`='$_date_htc', `date_EHC`='$_date_ehtc', `TCP`='$_tcp', `EDCP`='$_tcp_date', `img`='$newfileName', `date_up`=NOW(), `card`='$_redio', `amana_get`='$newKay',`title_hc`='$_title' WHERE `id`='$id'");

    
    if ($updateData) {
        $url = $printCard . '?id=' . $id . '';
        echo "<script>window.open('$url', '_blank');</script>";

    } else {
        return errorLog('error');
    }

}