<?php
session_start();
include('../../routes.php');
include('../../array_amana.php');

if (!isset($_SESSION['admin'])) {
  return exit(header('Location: ' . $errorPage . ''));
}
include('../../db/db.php');
$row_num = array();
for ($i = 0; $i <  count($amana_array); $i++) {
  $query = "SELECT id FROM contact WHERE amana = '" . $amana_array[$i] . "'  ORDER BY id";
  $query_rowc = mysqli_query($db, $query);
  $row_num[] = mysqli_num_rows($query_rowc);
}

function format_number($number)
{
  if ($number >= 1000) {
    return $number / 1000 . "k";   // NB: you will want to round this
  } else {
    return $number;
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" type="image/x-icon" href="../../../fav.ico">
  <link rel="icon" type="image/png" sizes="16x16" href="../../../images/fav.png">
  <link rel="icon" type="image/x-icon" href="../../../fav.ico">
  <script src="../../../js/jquery.js"></script>
  <script>
		$(document).ready(function() {
			setInterval(function() {
				$.ajax({
					url: "class/live_data_table.php",
					type: "POST",
					success: function(response) {
						$("#live-data").html(response);
					}
				});
			}, 1000); // refresh data every second
		});
	</script>
</head>

<body>

  <div class="max-w-2xl mx-auto">

    <form method="POST">
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
      <br>
      <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="search"  id="search" name="search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ID Number, Name, job..." required>
        
      </div>
      
    </form>

  </div> <br>
  <?php


  ?>
  <!-- component -->
  <div class="container flex flex-col gap-4 mx-8">
    <div class="bg-gray-100 rounded-lg w-full h-auto py-4 flex flex-row justify-between divide-x divide-solid divide-gray-400">
      <?php
      for ($i = 0; $i <  count($amana_array); $i++) {
        echo '
  <div class="relative flex-1 flex flex-col gap-2 px-4">
  <label class="text-gray-800 text-base font-semibold tracking-wider">' . $amana_array[$i] . '</label>
  <label class="text-green-800 text-4xl font-bold">' . format_number($row_num[$i]) . '</label>

</div>
  ';
      }
      ?>

    </div>
  </div>
  </div><br>
  <div id="response" class="max-w-2xl mx-auto"></div>


  <!-- component -->
  <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5" >
    <table class="w-auto border-collapse bg-white text-left text-sm text-gray-500">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID Num</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Gender</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nationality</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">job</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">HCN</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">DATE IHC</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">DATE EHC</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">TCP</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">DATE ETCP</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="display">
      </tbody>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="live-data">
 
      </tbody>
    </table>
  </div>
  <!-- Page JS -->
  <script type="text/javascript">
    //Getting value from "ajax.php".
    function fill(Value) {
      //Assigning value to "search" div in "search.php" file.
      $('#search').val(Value);
      //Hiding "display" div in "search.php" file.
      $('#display').hide();
      $('#live-data').show();

    }
    $(document).ready(function() {
      //On pressing a key on "Search box" in "search.php" file. This function will be called.
      $("#search").keyup(function() {
        //Assigning search box value to javascript variable named as "name".
        var name = $('#search').val();
        //Validating, if "name" is empty.
        if (name == "") {
          //Assigning empty value to "display" div in "search.php" file.
          $("#display").html("");
          $('#live-data').show();

        }
        //If name is not empty.
        else {
          //AJAX is called.
          $.ajax({
            //AJAX type is "Post".
            type: "POST",
            //Data will be sent to "ajax.php".
            url: "search.php",
            //Data, that will be sent to "ajax.php".
            data: {
              //Assigning value of "name" into "search" variable.
              search: name
            },
            //If result found, this funtion will be called.
            success: function(html) {
              //Assigning result to "display" div in "search.php" file.
              $("#display").html(html).show();
              $('#live-data').hide();

            }
          });
        }
      });
    });

    $(document).on('click', '.delete-contact-btn', function(e) {
      e.preventDefault();

      var id = $(this).data('id');

      $.ajax({
        url: 'class/del_table_card.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          $('#response').html(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

    
    $(document).on('click', '.block-contact-btn', function(e) {
      e.preventDefault();

      var id = $(this).data('id');

      $.ajax({
        url: 'class/block_table_card.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          $('#response').html(response);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  </script>

</body>

</html>