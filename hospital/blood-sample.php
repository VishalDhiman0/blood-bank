<?php

  
    require_once('../partials/top.php');

    if(!isset($_SESSION['username_h'])) {
        header('Location: ../login.php');
    }
    $isInserted = false;

    $hospital_id = $_SESSION['uniqueId'];
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $blood_group = $_POST['bloodgroup'];
        $tb_name = "blood_sample";
        $sql = "INSERT INTO {$tb_name} ( blood_group , hospital_id ) VALUES ('{$blood_group}', '{$hospital_id}');";

        $inserted = mysqli_query($connection, $sql);

        if($inserted) {
            $isInserted = true;
        }
    }

    require_once('../partials/header.php');

?>

    <form
        action="./blood-sample.php"
        method="post"
        id="main-content"
        class="bg-success p-3 rounded"
        >
      <h3 class="text-center text-white">Add Blood Sample</h3>
      <div class="mb-3">
        <select class="w-100 p-2 text-danger rounded" name="bloodgroup">
          <option value disabled selected>select blood group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
        </select>
      </div>
      <div class="mb-3 d-grid p-2">
        <button type="submit" name="submit" class="btn btn-primary">Add Sample</button>
      </div>
    </form>

<?php

    require_once '../partials/bottom.php';
?>