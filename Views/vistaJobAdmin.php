<?php include_once("header.php"); ?>
<main class="d-flex align-items-center justify-content-center opacity-25">
    <div class="bg-body mx-0 w-50">
        <h1 class="text-center font-monospace" style="font-family: myFuente; font-size: 60px; font-weight: bold; color:blue;">Menu Job</h1>
    </div>
    <div class="content">
        <div class="login-form p-5 mb-2 bg-transparent text-white border border-primary">
            <div class="d-flex mb-5 justify-content-around bg-primary text-white">
                <a href="<?php echo FRONT_ROOT?>Job/ShowProfileViewAdmin" class="btn btn-primary px-5" aria-current="page">Job Position List</a>
            </div>
            <div class="d-flex mb-5 justify-content-around bg-primary text-white">
                <a href="<?php echo FRONT_ROOT?>JobOffer/ShowAddView" class="btn btn-primary px-5" aria-current="page">Add JobOffer</a>
                <a href="<?php echo FRONT_ROOT?>JobOffer/ShowProfileView" class="btn btn-primary px-5" aria-current="page">List JobOffer</a>

            </div>
            <a href="<?php echo FRONT_ROOT ?>Home/IndexAdmin" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
        </div>
    </div>
</main>
<?php include_once("footer.php"); ?>