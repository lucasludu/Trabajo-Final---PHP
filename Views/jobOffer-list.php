<?php require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-lg">
            <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Job Offer List</h1>
            </div>
            <table class="table table-success table-striped">
                <thead>
                    <th>Job Offer Id</th>
                    <th>Published Date</th>
                    <th>Finish Date</th>
                    <th>Task</th>
                    <th>Skills</th>
                    <th>Salary</th>
                    <th>Job Position</th>
                    <th>Company ID</th>
                    <th>Action</th>
                </thead>
                <tbody class="table-info"> 
                    <?php foreach($jobOfferList as $jobOffer) { ?>
                        <tr>
                            <td><?php echo $jobOffer->getJobOfferId(); ?></td>
                            <td><?php echo $jobOffer->getPublishedDate(); ?></td>
                            <td><?php echo $jobOffer->getFinishDate(); ?></td>
                            <td><?php echo $jobOffer->getTask(); ?></td>
                            <td><?php echo $jobOffer->getSkills(); ?></td>
                            <td><?php echo $jobOffer->getSalary(); ?></td>
                            <td><?php echo $jobOffer->getJobs()->getJobPositionId(); ?></td>
                            <td><?php echo $jobOffer->getCompany()->getCompanyId(); ?></td>
                            <td>
                                <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>JobOffer/ShowModifyView/<?php echo $jobOffer->getJobOfferId(); ?>" class="btn btn-success p-auto">Edit</a>
                                <a type="submit" href="<?php echo FRONT_ROOT ?>JobOffer/DeleteJobOffer/ <?php echo $jobOffer->getJobOfferId(); ?>" class="btn btn-danger p-auto">Delete</a> 
                                <a type="submit" href="../Views/Excel.php" class="btn btn-danger p-auto">Download </a> 

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
            <div>

            <a href="<?php echo FRONT_ROOT ?>Job/LogoutMenuJob" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
        </div>
    </section>
</main>
<?php require_once('footer.php'); ?>
