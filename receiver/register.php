<?php

  require('../partials/top.php');
  $isRegistered = false;
  $alreadyRegister = false;
  $tb_name = "blood_receiver_users";

  $sql = "CREATE TABLE IF NOT EXISTS " . $tb_name . " (
    receiver_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    address VARCHAR(50) NOT NULL,
    bloodgroup VARCHAR(10) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ";

  $created = mysqli_query($connection, $sql);

  if($created) {

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

      $fullname = $_POST['fullname'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $bloodgroup = $_POST['bloodgroup'];
      $password = $_POST['password'];


      $sql = "SELECT * FROM $tb_name WHERE email = '$email';";

      $res = mysqli_query($connection, $sql);

      if ($res->num_rows) {
        $alreadyRegister = true;
      } else {
        $sql = "INSERT INTO {$tb_name} ( fullname, email, address, bloodgroup, password) VALUES ( ' {$fullname} ' , '{$email}', '{$address}', '{$bloodgroup}', '{$password}' );" ;
        $inserted = mysqli_query($connection, $sql);
          
        if($inserted) {
            $isRegistered = true;
        }
                  
      }

  }

  }


  require_once '../partials/header.php';
?>


    <?php
    if($isRegistered) {
        ?> <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            You are successfully registered. 
        <a style="text-decoration: none;" href="../login.php">Click here to <strong>Login!</strong></a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
    }else if ($alreadyRegister) {
      ?>

<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            This email is already registered with us. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

      <?php
    }
    ?>
  


    <form
      action="./register.php"
      method="post"
      id="main-content"
      class="bg-success p-3 rounded"
    >
      <h3 class="text-center text-white">Register</h3>
      <div class="mb-3">
        <input class="form-control" required placeholder="full name" name="fullname" type="text" />
      </div>
      <div class="mb-3">
        <input class="form-control" required placeholder="email" name="email" type="email" />
      </div>
      <div class="mb-3">
        <input class="form-control" required placeholder="address" name="address" type="text" />
      </div>
      <div class="mb-3">
        <select required class="w-100 p-2 text-danger rounded" name="bloodgroup">
          <option value disabled selected>select your blood group</option>
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
      <div class="mb-3">
        <input class="form-control" required minlength="5" placeholder="password" name="password" type="password" />
      </div>
      <div class="mb-3">

      <div class="mb-3 d-grid p-2">
        <button type="submit" name="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
 <?php
 
 
 require_once '../partials/bottom.php';
 ?>