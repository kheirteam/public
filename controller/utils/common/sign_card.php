<?php
include('../../db/db.php');
include('../../routes.php');
include('../../array_amana.php');

session_start();


if (!isset($_SESSION['admin'])) {
    return exit(header('Location: ' . $errorPage . ''));
}



?>
<!doctype html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../../fav.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../images/fav.png">
    <link rel="icon" type="image/x-icon" href="../../../fav.ico">

</head>

<body>
    <div id="response" class="max-w-2xl mx-auto"></div>

    <!-- component -->
    <section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">

        <h1 class="text-xl font-bold text-white capitalize dark:text-white">اضافة كارت جديد</h1>
        <form id="signcard-form" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-white dark:text-gray-200" for="name">الاسم</label>
                    <input id="name" name="name" maxlength="36" required type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="ID_Number">الهوية</label>
                    <input id="ID_Number" name="id_num" required minlength="6" type="number"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="Gender">نوع</label>
                    <select
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        id="Gender" name="gender">
                        <option value="0" selected>ذكر</option>
                        <option value="1">انثى</option>

                    </select>
                </div>

                <div id="nationality_input">
                    <label class="text-white dark:text-gray-200" for="nationality">الجنسية</label>
                    <input id="nationality" type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="text-white dark:text-gray-200" for="nationality_selcet">الجنسية</label>
                    <select
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        id="nationality_selcet" name="nationality">

                    </select>
                </div>

                <div id="job_input">
                    <label class="text-white dark:text-gray-200" for="job">العمل</label>
                    <input id="job" type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="text-white dark:text-gray-200" for="job_selcet">العمل</label>
                    <select
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        id="job_selcet" name="job">

                    </select>
                </div>
                <div>
                    <label class="text-white dark:text-gray-200" for="hcn">رقم الشهادة الصحية</label>
                    <input id="hcn" type="number" name="hcn"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="text-white dark:text-gray-200" for="date_htc">تاريخ إصدار الشهادة الصحية</label>
                    <input id="date_htc" name="date_htc" required  type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="amana">الامانة</label>
                    <select
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        id="amana" name="amana">
                        <?php
                        foreach ($amana_array as $a) {
                            echo '<option>' . $a . '</option>';
                        }

                        ?>
                    </select>
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="date_ehtc">تاريخ انتهاء الشهادة الصحية</label>
                    <input id="date_ehtc" name="date_ehtc" required type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="tcp">نوع البرنامج التثقيفي</label>
                    <input id="tcp" type="text" name="tcp"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div>
                    <label class="text-white dark:text-gray-200" for="tcp_date">تاريخ انتهاء البرنامج التثقيفي</label>
                    <input id="tcp_date" name="tcp_date" type="text"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="block text-sm font-medium text-white">
                        Image
                    </label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md drag-and-drop">
                        <div class="space-y-1 text-center">
                            <img id="preview" width="200px" height="200px">

                            <svg class="mx-auto h-12 w-12 text-white" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>


                            <div class="flex text-sm text-gray-600">
                                <label for="imageInput"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span class="">Upload a file</span>
                                    <input type="file" name="file" class="sr-only" accept=".jpg, .jpeg, .png"
                                        id="imageInput">
                                </label>
                            </div>
                            <p class="text-xs text-white">
                                PNG, JPG, GIF up to 1MB
                            </p>
                        </div>
                    </div>
                </div>


                <div class="flex items-center mb-4">
                    <input checked id="default-radio-2" type="radio" value="6" name="c"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        6-خانات </label>
                    <input id="default-radio-1" type="radio" value="8" name="c"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        8-خانات </label>

                </div>
                <div class="flex items-center mb-4">
                    <input checked id="title_0" type="radio" value="0" name="title"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="title_0" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                     موحدة </label>
                    <input id="title_1" type="radio" value="1" name="title"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="title_1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        سنوية </label>

                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600"
                    name="save" type="submit">Save</button>
            </div>
        </form>



    </section>

    <script src="../../../js/jquery.js"></script>


    <!-- Image Preview-->
    <script>
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');
        $('#preview').hide();

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                $('#preview').show();
                preview.src = reader.result;
            });
            reader.readAsDataURL(file);
        });
    </script>

    <!-- Nationality -->
    <script>
        var nationalitySelect = $("#nationality_selcet");
        var otherInput_nationality = $("#nationality_input");
        var other_nationality = $("#nationality");
        otherInput_nationality.hide();

        function toggleOtherNationality() {
            if (nationalitySelect.val() == "other") {
                otherInput_nationality.show();
            } else {
                otherInput_nationality.hide();
            }
        }

        nationalitySelect.on("change", toggleOtherNationality);
        other_nationality.on("keyup", function () {
            var otherOption = $("#nationality_selcet #other_nationality");
            otherOption.val(other_nationality.val());
        });
        toggleOtherNationality(); // call once to initialize
    </script>
 <!-- Job -->
 <script>
        var jobSelect = $("#job_selcet");
        var otherInput_job = $("#job_input");
        var other_job = $("#job");
        otherInput_job.hide();

        function toggleOtherjob() {
            if (jobSelect.val() == "other") {
                otherInput_job.show();
            } else {
                otherInput_job.hide();
            }
        }

        jobSelect.on("change", toggleOtherjob);
        other_job.on("keyup", function () {
            var otherOption = $("#job_selcet #other_job");
            otherOption.val(other_job.val());
        });
        toggleOtherjob(); // call once to initialize
    </script>

    <!-- Health Card Number -->
    <script>
        var hcnInput = $("#hcn");
        var randomNum = Math.floor(Math.random() * 11) + 11;

        function checkHcnInput() {
            if (hcnInput.val('')) {
                hcnInput.prop('readonly', false);
            } else {
                hcnInput.prop('readonly', true);
            }
        }

        function updateHcnInput() {
            $.ajax({
                url: "class/get_hcn.php",
                success: function (response) {
                    if (response !== '') {
                        var newResponse = parseInt(response) + randomNum;
                        hcnInput.val(newResponse);
                        hcnInput.prop('readonly', true);
                    } else {
                        hcnInput.prop('readonly', false);
                    }
                }
            });
        }

        checkHcnInput(); // call once to initialize
        setInterval(updateHcnInput, 1000); // refresh data every second
    </script>

    <!-- Get Countries -->
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'class/get_countries.php',
                dataType: 'json',
                success: function (response) {
                    var select = $('#nationality_selcet');
                    var newOption = '<option id="other_nationality" value="other">اختار جنسية اخرى</option>';
                    for (var i = 0; i < response.length; i++) {
                        select.append('<option value="' + response[i] + '">' + response[i] + '</option> ');
                    }
                    select.append(newOption);
                }
            });
        });
    </script>
    <!-- Get Job -->
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'class/get_job.php',
                dataType: 'json',
                success: function (response) {
                    var select = $('#job_selcet');
                    var newOption = '<option id="other_job" value="other">اختار اعمال اخرى</option>';
                    for (var i = 0; i < response.length; i++) {
                        select.append('<option value="' + response[i] + '">' + response[i] + '</option> ');
                    }
                    select.append(newOption);
                }
            });
        });
    </script>
    <!-- Send Card -->
    <script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script src="moment-hijri.js"></script>
    <script>
$(document).ready(function() {
  moment.locale('en-SA'); // set the global locale to `en-SA`
  var m = moment();
  var formattedDate = m.format('iYYYY-iM-iD'); // format the date as "yyyy-MM-dd"
  $('#date_htc').val(formattedDate); // set the value of the element with ID 'date_htc'
  $('#tcp_date').val(formattedDate); // set the value of the element with ID 'date_htc'
  var mPlusOneYear = m.add(1, 'iYear'); // add 1 year to the date
  var formattedDatePlusOneYear = mPlusOneYear.format('iYYYY-iM-iD'); // format the new date as "yyyy-MM-dd"
  $('#date_ehtc').val(formattedDatePlusOneYear); // set the value of the element with ID 'date_ehtc'
});
</script>
    <script>
        $(document).ready(function () {
            $('#signcard-form').submit(function (event) {
                event.preventDefault(); // prevent default form submit action
                var formData = new FormData(this); // create form data object
                $.ajax({
                    url: 'sign_card_js.php', // server-side script to handle form submission
                    type: 'POST',
                    data: formData, // form data object
                    contentType: false, // tell jQuery not to set contentType
                    processData: false, // tell jQuery not to process data
                    success: function (response) {
                        $('#response').html(response); // display response message
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText); // log error message to console
                    }
                });
            });
        
        });

    </script>

</body>

</html>