 
 <?php
 include('../../db/db.php');
 include('../../routes.php');
 if (isset($_POST['search'])) {
    $Name = $_POST['search'];
    
     if(strpos($Name,'#') !== false){
         $newName = str_replace("#","",$Name);
             $Sqli_con = mysqli_query($db, "SELECT * FROM `contact` WHERE (`name` LIKE '%$newName%' OR `ID_Number` LIKE '%$newName%' OR  `HCN` LIKE '%$newName%' OR  `job` LIKE '%$newName%' ) AND `block`=1 LIMIT 10");

         
     }else{
            $Sqli_con = mysqli_query($db, "SELECT * FROM `contact` WHERE (`name` LIKE '%$Name%' OR `ID_Number` LIKE '%$Name%' OR  `HCN` LIKE '%$Name%' OR  `job` LIKE '%$Name%' ) LIMIT 10");
 
     }
  
     
 }
 ?>

        <?php
        while ($row = mysqli_fetch_assoc($Sqli_con)) {
          if($row['block'] == 0){

            $pathSvg = '  <path d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.455 9.455 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065zm-2.183 2.183c.226-.226.185-.605-.1-.75A6.473 6.473 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091l.016-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z"/>  ';
    $style_id ='bg-green-50 text-green-600';
    
              
          }else{
            $pathSvg='<path d="M10.706 3.294A12.545 12.545 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c.63 0 1.249.05 1.852.148l.854-.854zM8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065 8.448 8.448 0 0 1 3.51-1.27L8 6zm2.596 1.404.785-.785c.63.24 1.227.545 1.785.907a.482.482 0 0 1 .063.745.525.525 0 0 1-.652.065 8.462 8.462 0 0 0-1.98-.932zM8 10l.933-.933a6.455 6.455 0 0 1 2.013.637c.285.145.326.524.1.75l-.015.015a.532.532 0 0 1-.611.09A5.478 5.478 0 0 0 8 10zm4.905-4.905.747-.747c.59.3 1.153.645 1.685 1.03a.485.485 0 0 1 .047.737.518.518 0 0 1-.668.05 11.493 11.493 0 0 0-1.811-1.07zM9.02 11.78c.238.14.236.464.04.66l-.707.706a.5.5 0 0 1-.707 0l-.707-.707c-.195-.195-.197-.518.04-.66A1.99 1.99 0 0 1 8 11.5c.374 0 .723.102 1.021.28zm4.355-9.905a.53.53 0 0 1 .75.75l-10.75 10.75a.53.53 0 0 1-.75-.75l10.75-10.75z"/>';
            
                        $style_id ='bg-red-50 text-red-600';

            
          }
        
          $gander =  $row['gender'] == 0 ? 'ذكر' : 'انثى';
          echo '   
          <tr class="hover:bg-gray-50">
<th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
  <div class="relative h-10 w-10">
    <img
      class="h-full w-full rounded-full object-cover object-center"
      src="../../../images/users/' . $row['img'] . '"
      alt=""
    />
  </div>
  <div class="text-sm">
    <div class="font-medium text-gray-700">' . $row['name'] . '</div>
    <div class="text-gray-400">' . $row['amana'] . ',' . $row['balady'] . '</div>
  </div>
</th>
<td class="px-6 py-4">
  <span
    class="inline-flex items-center gap-1 rounded-full  px-2 py-1 text-xs font-semibold '.$style_id.' "
  >
    ' . $row['ID_Number'] . '
  </span>
</td>
<td class="px-6 py-4">' . $gander . '</td>
<td class="px-6 py-4">
 ' . $row['nationality'] . '
</td>
<td class="px-6 py-4">
 ' . $row['job'] . '
</td>
<td class="px-6 py-4">
 ' . $row['HCN'] . '
</td>
<td class="px-6 py-4">
 ' . $row['date_IHC'] . '
</td>
<td class="px-6 py-4">
 ' . $row['date_EHC'] . '
</td>
<td class="px-6 py-4">
 ' . $row['TCP'] . '
</td>
<td class="px-6 py-4">
 ' . $row['EDCP'] . '
</td>
<td class="px-6 py-4">
<div class="flex justify-end gap-4">
<a href="javascript:void(0)" class="delete-contact-btn" data-id="' . $row['id'] . '">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
<path
  stroke-linecap="round"
  stroke-linejoin="round"
  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
/>
</svg>
</a>

<a href="'.$editCardPage.'?id='.$row['id'].'" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip"
>
<path
  stroke-linecap="round"
  stroke-linejoin="round"
  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
/>
</svg>
</a>
<a href="javascript:void(0)"  class="block-contact-btn" data-id="' . $row['id'] . '">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip"
>

'.    $pathSvg.'
</svg>
</a>
<a  href="'.$printCard.'?id=' . $row['id'] . '" target="_blank">
<svg
xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="h-6 w-6"
x-tooltip="tooltip"
>
<path  stroke-linecap="round"
stroke-linejoin="round" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
<path      stroke-linecap="round"
stroke-linejoin="round" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
</svg>
</a>
</div>
</td>
</tr>';
        }

        ?>



