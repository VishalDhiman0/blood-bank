<?php

define('__ROOT__', dirname(dirname(__FILE__)));
        // STARTING A SESSION
        session_start();

        // CONNECTION TO DATABASE
        require_once __ROOT__.'/_dbconnect.php';
        $tb_name = "blood_sample";
        
        // TO CHECK IF USER IS LOGGED-IN OR NOT
        $isReceiverLoggedIn = false;
        $isHospitalLoggedIn = false;
    
        // IF LOGGED IN AS RECEIVER
        if(isset($_SESSION['username_r'])) {
          $isReceiverLoggedIn = true;
        }
    
        // IF LOGGED IN AS HOSPITAL
        if(isset($_SESSION['username_h'])) {
          $isHospitalLoggedIn = true;
        };

?>