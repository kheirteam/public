<?php
session_start();
include('../controller/routes.php');
// 0shark done,1 qisem done, 2 aser done, 3 gada , 4 reyad ,5 maka 
$id = $_GET['id']; // 8,6


if (!isset($id) || !isset($_SESSION['admin'])) {

  return header('Location: ' . $errorPage . '');

}

include('../controller/db/db.php');

$get_data = mysqli_query($db, "SELECT * FROM `contact` WHERE `id` = '$id'");
$showData = mysqli_fetch_assoc($get_data);
$check_card = mysqli_num_rows($get_data);
if ($check_card == 0) {
  return header('Location:  ' . $errorPage . '');

}

$left_css = array(655, 655, 655, 615, 570, 685);
$top_css = array(18, 18, 20, 20, 20, 20);
$height_css = array(108, 108, 105, 106, 107, 110);
$img_amana = array('s.png', 'q.png', 'a.png', 'g.png', 'm.jpeg', 'r.png');

$card_6_img = '';
$card_8_img = '';
$class_print = '';
$card = $showData['card'];
$amana = $showData['amana_get'];
$title_hc = $showData['title_hc'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card</title>
  <link rel="shortcut icon" type="image/x-icon" href="../fav.ico">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/fav.png">
  <link rel="icon" type="image/x-icon" href="../fav.ico">
  <?php
  if ($card == 6) {
    echo '<link href="css/style.css" rel="stylesheet" type="text/css">';
    if ($amana == 4) {
      $card_6_img = '6c.png';
    } else {
      $card_6_img = '6.png';
    }

    $class_print = '.card-6';
  } else {
    echo '<link href="css/style_8.css" rel="stylesheet" type="text/css">';
    if ($amana == 4) {
      $card_8_img = '8c.png';
    } else {
      $card_8_img = '8.png';
    }
    $class_print = '.card-8';
  }
  $name_downlaod_image = $showData['HCN'] . '_' . $showData['ID_Number'] . '_' . date('d-m-Y-H-i-s', strtotime($date)) . '_' . '.png';

  $title = $title_hc == 0 ? 'شهادة صحية موحدة' : 'شهادة صحية سنوية';

  ?>

  <style>
    body {
      overflow: hidden;
    }

    .card-6 #rectangle-logo {
      position: absolute;
      left:<?php echo $left_css[$amana]; ?>px;
      top:<?php echo $top_css[$amana]; ?>px;

    }

    .card-6 #rectangle-logo img {
      width: 100%;
      height:<?php echo $height_css[$amana]; ?>px;
    }

    .card-8 #rectangle-logo {
      position: absolute;
      left:<?php echo $left_css[$amana]; ?>px;
      top:<?php echo $top_css[$amana]; ?>px;

    }

    .card-8 #rectangle-logo img {
      width: 100%;
      height:<?php echo $height_css[$amana]; ?>px;
    }

    .card-6 #rectangle-title,
    .card-8 #rectangle-title {
      position: absolute;
      right: 585px;
      top: 30px;
      width: 750px;
      height: 40px;
    }

    .card-6 #rectangle-title #title,
    .card-8 #rectangle-title #title {
      font-weight: 600;
      font-size: 42px;
      color: #fff;
      /* Vendor Prefixes */
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
  </style>
</head>

<body>



  <?php if ($card == 6) {

    echo '<div class="card-6">
    <img alt="logo" src="images/' . $card_6_img . '">
    <div id="rectangle-logo"><img src="images/' . $img_amana[$amana] . '"></div>
<div id="rectangle-title" dir="rtl"><span id="title">' . $title . '</span></div>
<div id="rectangle-name" dir="rtl"><span id="name">' . $showData['name'] . '</span></div>

<div id="rectangle-id"  dir="ltr" ><span id="id-num">' . $showData['ID_Number'] . '</span></div>

<div id="rectangle-ntion"  dir="ltr" > <span id="ntion">' . $showData['nationality'] . '</span></div>

<div id="rectangle-num_h"  dir="ltr" ><span id="num_h">' . $showData['HCN'] . '</span></div>

<div id="rectangle-job"  dir="ltr" ><span id="job">' . $showData['job'] . '</span></div>

<div id="rectangle-date_i"  dir="ltr" > <span id="date_i">' . date("Y/m/d", strtotime($showData['date_IHC'])) . '</span></div>

<div id="rectangle-date_e"  dir="ltr" ><span id="date_e">' . date("Y/m/d", strtotime($showData['date_EHC'])) . '</span></div>

<div id="rectangle-img"><img src="../images/users/' . $showData['img'] . '"></div>

<div id="rectangle-qrcode">
  <div id="qrcode"></div>
</div>

</div>';
  } else {
    $date_TCP = $showData['EDCP'] == "" ? "" : date("Y/m/d", strtotime($showData['EDCP']));
    echo '<div class="card-8">
    <img alt="logo" src="images/' . $card_8_img . '">
    <div id="rectangle-logo"><img src="images/' . $img_amana[$amana] . '"></div>
    <div id="rectangle-title" dir="rtl"><span id="title">' . $title . '</span></div>

<div id="rectangle-name" dir="rtl"><span id="name">' . $showData['name'] . '</span></div>

<div id="rectangle-id"><span id="id-num">' . $showData['ID_Number'] . '</span></div>

<div id="rectangle-ntion"> <span id="ntion">' . $showData['nationality'] . '</span></div>

<div id="rectangle-num_h"><span id="num_h">' . $showData['HCN'] . '</span></div>

<div id="rectangle-job"><span id="job">' . $showData['job'] . '</span></div>

<div id="rectangle-date_i"> <span id="date_i">' . date("Y/m/d", strtotime($showData['date_IHC'])) . '</span></div>

<div id="rectangle-date_e"><span id="date_e">' . date("Y/m/d", strtotime($showData['date_EHC'])) . '</span></div>
<div id="rectangle-tcp"> <span id="tcp">' . $showData['TCP'] . '</span></div>

<div id="rectangle-tcp_date"><span id="tcp_date">' . $date_TCP . '</span></div>

<div id="rectangle-img"><img src="../images/users/' . $showData['img'] . '"></div>

<div id="rectangle-qrcode">
  <div id="qrcode"></div>
</div>

</div>';
  } ?>


  <input type="hidden" id="text"
    value="https://apps.balaaday.com/printedLicenses.php?qr=<?php echo $showData['uid'] ?>">



  <script src="js/html2canvas.min.js"></script>
  <script src="js/qrcode.js"></script>
  <script src="js/qrcode.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      width: 183,
      height: 183
    });

    function makeCode() {
      var elText = document.getElementById("text");

      if (!elText.value) {
        elText.value = 'google.com';
        elText.focus();
        return;
      }

      qrcode.makeCode(elText.value);
    }

    makeCode();

    $("#text").
      on("blur", function () {
        makeCode();
      }).
      on("keydown", function (e) {
        if (e.keyCode == 13) {
          makeCode();
        }
      });
  </script>

  <script>

    // الحصول على العنصر الذي يحمل الكلاس "card-6 - 8"
    const element = document.querySelector("<?php echo $class_print; ?>");

    // إنشاء Canvas وتحويل العنصر إلى صورة
    html2canvas(element, {

      useCORS: true,
      logging: true,
      allowTaint: true,
      allowPopups: true,// تمكين فتح النافذة المنبثقة
      backgroundColor: "transparent",
      width: 1012,
      height: 638

    }).then(canvas => {
      // تحويل Canvas إلى بيانات URL للصورة بتنسيق JPG
      const imgData = canvas.toDataURL("image/jpeg", 1.0);

      // إنشاء عنصر a لتنزيل الصورة
      const link = document.createElement("a");
      link.download = "<?php echo $name_downlaod_image; ?>";
      link.href = imgData;
       link.click();
      //   setTimeout(function() {
      //   window.close();
      // }, 500);

    });
  </script>

</body>

</html>