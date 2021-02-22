<?php


    require_once('../partials/top.php');


    $tb_name = "requests";

    $sql = "CREATE TABLE IF NOT EXISTS {$tb_name} ( id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, receiver_id int UNSIGNED , bloodsample_id int UNSIGNED, FOREIGN KEY (receiver_id) REFERENCES blood_receiver_users(receiver_id), FOREIGN KEY (bloodsample_id) REFERENCES blood_sample(id)) ";
    $created = mysqli_query($connection, $sql);

    $hospital_id = $_SESSION['uniqueId'];


    if($created) {
    $sql = "SELECT blood_sample.blood_group,  blood_receiver_users.fullname,blood_receiver_users.address FROM requests INNER JOIN blood_sample ON blood_sample.id = requests.bloodsample_id INNER JOIN blood_receiver_users ON blood_receiver_users.receiver_id = requests.receiver_id WHERE blood_sample.hospital_id = {$hospital_id};";


        $res = mysqli_query($connection, $sql);

     

        if(isset($_SESSION['username_h'])) {
        
        }
        
 
    }


    require_once('../partials/header.php')
?>



<table class="table">

<tr>
<th> # </th>
<th>Blood Group</th>
<th>Name</th>
<th> Address </th> 
</tr>
<?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr> <td> $count </td> ";
            foreach ($row as $key=>$value) {
                echo "<td>$value</td>";
            } 

            echo '</tr>';
            $count++;
        }
?>

</table>

<?php
        require_once('../partials/bottom.php');
        ?>
     