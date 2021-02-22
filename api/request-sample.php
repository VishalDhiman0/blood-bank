<?php


session_start();
require '../_dbconnect.php';

if (!isset($_SESSION['username_r'])) {
    http_response_code(403);
    die();
} 

if (!isset($_POST['bloodSampleId'])) {
    http_response_code(400);
    die();
} 

$tb_name = 'requests';


$unique_id = $_SESSION['uniqueId'];
$blood_sample_id = $_POST['bloodSampleId'];

$sql = "INSERT INTO {$tb_name}(receiver_id, bloodsample_id) VALUES({$unique_id},{$blood_sample_id});";

$res = mysqli_query($connection, $sql);
var_dump($res);


?>