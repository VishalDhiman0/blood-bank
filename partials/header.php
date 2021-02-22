<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/assignment/style.css" type="text/css" />
    <title>Blood-Bank</title>
  </head>

  <body>
      <?php
        if($isReceiverLoggedIn) {
            require_once __ROOT__.'/receiver/header-loggedin.php';
        } 
        else if($isHospitalLoggedIn) {
            require_once __ROOT__.'/hospital/header-loggedin.php';
        }
        else {
            require_once __ROOT__.'../header-loggedout.php';
        }
      ?>
