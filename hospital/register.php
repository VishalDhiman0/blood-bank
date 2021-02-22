<?php

  require('../partials/top.php');
  $isRegistered = false;
  $tb_name = 'hospital_users';
  $alreadyRegister = false;

  $sql = "CREATE TABLE IF NOT EXISTS " . $tb_name . " (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    address VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  $created = mysqli_query($connection, $sql);

  if($created) {

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

      $email = $_POST['email'];
      $name = $_POST['name'];
      $address = $_POST['address'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM $tb_name WHERE email = '$email';";

      $res = mysqli_query($connection, $sql);

      if ($res->num_rows) {
        $alreadyRegister = true;
      } else {
        $sql = "INSERT INTO {$tb_name} ( email, name, address, password) VALUES ('{$email}', '{$name}', '{$address}','{$password}' );" ;
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
        <input class="form-control" placeholder="hospital email" type="email" name="email" required/>
      </div>
      <div class="mb-3">
        <input class="form-control" placeholder="hospital name" name="name" type="text" />
      </div>
      <div class="mb-3">
        <input class="form-control" placeholder="hospital address" name="address" type="text" />
      </div>
      <div class="mb-3">
        <input class="form-control" placeholder="password" name="password" type="password" />
      </div>
      <div class="mb-3">
      <div class="mb-3 d-grid p-2">
        <button type="submit" name="submit" class="btn btn-primary">Register</button>
      </div>
    </form>
    <?php
 
 
 require_once '../partials/bottom.php';
 ?>