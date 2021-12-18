<?php 
if(isset($_SESSION['loggedUser'])) {
    require_once('header.php'); ?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Postulation</h2>
            <form action="<?php echo FRONT_ROOT ?>Appoitment/Add" method="post" class="bg-light-alpha p-5">
                <div class="col-lg-4" style="padding-left: 0px;">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $jobOfferId ?>">
                    </div>
                </div>
                <div class="col-lg-4" style="padding-left: 0px;">
                    <div class="form-group">
                        <label for=""><strong>Company: </strong> <?php echo $companyName ?> </label>
                    </div>
                </div>
                <div class="col-lg-4" style="padding-left: 0px;">
                    <div class="form-group">
                        <label for=""><strong>Job Position: </strong> <?php echo $job ?> </label>
                    </div>
                </div>
                <div class="col-lg-8" style="padding-left: 0px;">
                    <div class="form-group">
                        <label for=""> <strong> Messagge </strong> </label>
                        <input type="text" name="message" value="" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4" style="padding-left: 0px;">
                    <div class="form-group">
                        <label for=""> <strong> Upload CV </strong></label>
                        <input type="file" name="cv" value="" >
                    </div>
                </div>
                <div style="text-align: center; display: flex; align-items: center; justify-content: center;">
                    <button type="submit" class="btn btn-dark d-block">Postulate</button>
                </div>
            </form>
            <a href="<?php echo FRONT_ROOT ?>Student/ShowProfileView" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
        </div>
    </section>
    </main>
<?php
    } else {
        require_once(VIEWS_PATH."index.php");
    }
?>