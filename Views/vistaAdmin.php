<?php include_once("header.php"); ?>
<main class="d-flex align-items-center justify-content-center opacity-25">
    <div class="bg-body mx-0 w-50">
        <h1 class="text-center font-monospace" style="font-family: myFuente; font-size: 60px; font-weight: bold; color:blue;">Menu Admin</h1>
    </div>
    <div class="content">
        <div class="login-form p-5 mb-2 bg-transparent text-white border border-primary">
            <div class="d-flex mb-5 justify-content-around bg-primary text-white">
                <a href="<?php echo FRONT_ROOT ?>Company/redirectionCompany" class="btn btn-primary" aria-current="page">Company</a>
                <a href="<?php echo FRONT_ROOT?>Job/LogoutMenuJob" class="btn btn-primary" aria-current="page">Jobs</a>
                <a href="<?php echo FRONT_ROOT?>Career/ShowProfileCareerView" class="btn btn-primary" aria-current="page">Career</a>
            </div>
            <div class="d-flex mb-5 justify-content-around bg-primary text-white">
                <a href="<?php echo FRONT_ROOT?>Student/ShowProfileStudentView" class="btn btn-primary" aria-current="page">Students</a>
                <a href="<?php echo FRONT_ROOT?>Student/ShowProfileUserView" class="btn btn-primary" aria-current="page">User</a>
                <a href="<?php echo FRONT_ROOT?>Appoitment/ShowProfileAppoitmentView" class="btn btn-primary" aria-current="page">Appoitment</a>
            </div>
            <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="btn btn-danger btn-block btn-lg">Exit</a>
        </div>
    </div>
</main>
<?php include_once("footer.php"); ?>