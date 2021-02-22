<?php
$username = "USER";
if(isset($_SESSION['username_r'])) {
    $username = $_SESSION['username_r'];
}   
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <span class="navbar-brand text-light"><a class="navbar-brand" href="/assignment">Blood-Bank</a></span>
            <div class="d-flex justify-content-end" id="navbarSupportedContent">
                <span class="text-light"> Welcome <strong>  <?php echo $username; ?> </strong> <span>
                <button class="btn btn-outline-dark m-2 p-0"><a class="nav-link text-light" href="./logout.php">Logout</a></button>
            </div>
        </div>
    </nav>

