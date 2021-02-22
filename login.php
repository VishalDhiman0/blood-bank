<?php

  // STARTIN SESSION

  require_once('./partials/top.php');


  // TO CHECK IF USER IS ALREADY LOGGED-IN
  if(isset($_SESSION['username_r']) || isset($_SESSION['username_h'])) {
    header("Location: ./bloodbank-home.php");
  }

  // CONNECTION TO DATABASE
  require('./_dbconnect.php');

  // CHECKING FOR A VALID HTTP REQUEST
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {


    // IF USER IS OF TYPE RECEIVER
    if($_POST['usertype'] == 1) {

      $tbname = "blood_receiver_users";
      $sql = "SELECT * FROM {$tbname} WHERE email= '{$_POST['email']}' and password = '{$_POST['password']}'";
      $result = mysqli_query($connection, $sql);

      if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username_r'] = $row['fullname'];
        $_SESSION['uniqueId'] = $row['receiver_id'];
        $_SESSION['email'] = $row['email'];
        header("Location: ./bloodbank-home.php");
      }
    }

    // IF USER IS OF TYPE HOSPITAL
    if($_POST['usertype'] == 2) {
      $tbname = "hospital_users";
      $sql = "SELECT * FROM {$tbname} WHERE email= '{$_POST['email']}' and password = '{$_POST['password']}'";
      $result = mysqli_query($connection, $sql);
      if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username_h'] = $row['name'];
        $_SESSION['uniqueId'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        header("Location: ./bloodbank-home.php");
      }
    }

  }
  require_once './partials/header.php';
?>


    <form
      action="./login.php"
      method="POST"
      id="main-content"
      class="bg-success p-3 text-white shadow-lg rounded"
    >
      <h3 class="text-center">Login</h3>
      <div class="mb-3">
        <select class="w-100 p-2 text-danger rounded" name="usertype">
          <option value="1" selected>Receiver</option>
          <option value="2">Hospital</option>
        </select>
      </div>
      <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="email" />
      </div>
      <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="password" />
      </div>
      <div class="mb-3 d-grid">
        <button type="submit" name="submit" class="btn btn-light text-secondary">
          login
        </button>
      </div>
    </form>
    <?php
 
 
 require_once './partials/bottom.php';
 ?>