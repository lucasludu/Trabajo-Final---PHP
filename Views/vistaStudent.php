<?php 
if(isset($_SESSION['loggedUser'])) {
    require_once('header.php'); ?>

<main class="d-flex align-items-center justify-content-center opacity-25">
    <div class="bg-body mx-0 w-50">
        <h1 class="text-center font-monospace" style="font-family: myFuente; font-size: 60px; font-weight: bold; color:blue;">Menu Student</h1>
    </div>
    <div class="content">
        <div class="login-form p-5 mb-2 bg-transparent text-white border border-primary">
            <div class="d-flex mb-5 justify-content-around bg-primary text-white">
                <a href="<?php echo FRONT_ROOT?>Company/ShowListView" class="btn btn-primary" aria-current="page">List of Companies</a>
                <a href="<?php echo FRONT_ROOT?>JobOffer/ShowListView" class="btn btn-primary" aria-current="page">Jobs</a>
                <a href="<?php echo FRONT_ROOT?>Student/ShowPersonalInformation" class="btn btn-primary" aria-current="page">Personal Information</a>
            </div>
            <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="btn btn-danger btn-block btn-lg">Exit</a>
        </div>
    </div>
</main>

<?php include_once("footer.php"); ?>
<?php
    } else {
        require_once(VIEWS_PATH."index.php");
    }
?>