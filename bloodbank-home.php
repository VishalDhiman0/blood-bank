<?php
  
  require_once('./partials/top.php');

    // CREATING TABLE IN DATABASE IF NOT EXISTS
    $sql = "CREATE TABLE IF NOT EXISTS " . $tb_name . " (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      blood_group VARCHAR(50) NOT NULL,
      hospital_id INT UNSIGNED NOT NULL, FOREIGN KEY (hospital_id) REFERENCES hospital_users(id)
    );";

    $result = mysqli_query($connection, $sql);

    // ARRAYS TO STORE BLOODGROUPS AND HOSPITAL NAMES TO BE DISPLAYED TO RECEIVER
    $keys = array();
    $bloodgroups = array();
    $hospitalNames = array();
    $uniqueId = null; 

    if (isset($_SESSION['uniqueId'])) {
      $uniqueId = $_SESSION['uniqueId']; 
    }

    $alreadyRequested = array();

    if($result) {
      $sql = "SELECT {$tb_name}.id, {$tb_name}.blood_group, {$tb_name}.hospital_id, hospital_users.name FROM {$tb_name} INNER JOIN hospital_users ON {$tb_name}.hospital_id = hospital_users.id;";
      $result = mysqli_query($connection, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        array_push($keys, $row['id']);
        array_push($hospitalNames, $row['name']);
        array_push($bloodgroups, $row['blood_group']);
      }

      if ($uniqueId) {

        $sql = "SELECT bloodsample_id FROM requests WHERE receiver_id = $uniqueId";

        $res = mysqli_query($connection, $sql);
  
      
  
        while ($row = mysqli_fetch_assoc($res)) {
          $alreadyRequested[$row['bloodsample_id']] = 1; 
        }
      }


    } 

    function buttonText($key) {
      global $alreadyRequested, $isReceiverLoggedIn, $keys;

     
        
        if($isReceiverLoggedIn) { 
          $text = 'Request Sample';
          $classes = 'btn-primary';
          if (isset($alreadyRequested[$key])) {
            $classes .= ' disabled';
            $text = 'Already Requested';
          }
          return '<td> <a class="btn '.$classes.' request-btn" id='.$key.' role="button">
          '.$text.'
           </a> </td>';
        } else {
          return '';
        }
      }


    

    require_once('./partials/header.php');


      ?>

      <table class="table mt-5">
        <thead class="table-danger">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Hospital Name</th>
            <th scope="col">Blood Type</th>
            <?php if($isReceiverLoggedIn) echo '<th scope="col"> Action </th>'; ?> 
          </tr> 
        </thead> 
        <tbody>

        <?php
        for($i = 0;$i < count($bloodgroups); $i++) {
            echo '<tr>
              <th scope="row"> ' , $i+1 , '</th>
              <td> ' , $hospitalNames[$i] , '</td>
              <td> ' , $bloodgroups[$i] , '</td>';
              echo buttonText($keys[$i]);
            echo '</tr>';
        }
        ?>

        </tbody>
      </table>
     

     <?php require_once('./partials/bottom.php'); ?>