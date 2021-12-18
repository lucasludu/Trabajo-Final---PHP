<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Add Job Offer</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>JobOffer/Add" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-transparent text-primary border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">     
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bolder;">Company</label>
                                <select name="companyName" class="form-control" style="width:65%" aria-label="Default select example" required>
                                    <?php  foreach($companyList as $value) { 
                                        if($value->getCompanyEmail() == $_SESSION['loggedUser']->getEmail()) { ?>

                                        
                                        <option value="<?php echo $value->getCompanyName() ?>">
                                            <?php echo $value->getCompanyName() ?>
                                        </option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>                                       
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                    <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bold;">Published Date</label>
                                    <input type="date" name="publishedDate" id="publishedDate" value="" class="form-control" style="width:65%" required>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                    <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bold;">Finish Date</label>
                                    <input type="date"  name="finishDate" id="finishDate" class="form-control" style="width:65%" required>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bolder;">Task</label>
                                <input type="text" name="task" value="" class="form-control" style="width:65%" required>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bolder;">Skills</label>
                                <input type="text" name="skills" value="" class="form-control" style="width:65%" required>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bolder;">Salary</label>
                                <input type="number" name="salary" value="" class="form-control" style="width:65%" required>
                            </div>
                        </div>
                        <div class="col-lg-10 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:17%; font-weight:bolder;">Careers</label>
                                <select name="careerId" class="form-control" style="width:73%" aria-label="Default select example" required>
                                    <?php  foreach($careerList as $value) { ?>
                                        <option value="<?php echo $value->getCareerId() ?>">
                                            <?php echo $value->getCareerId() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-10 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:17%; font-weight:bolder;">Job Position</label>
                                <select name="jobPositionId" class="form-control" style="width:73%" aria-label="Default select example" required>
                                    <?php  foreach($jobList as $value) { ?>
                                        <option value="<?php echo $value->getJobPositionId() ?>">
                                            <?php echo $value->getJobPositionId() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="button" style="width:25%; margin-left:10%;" class="btn btn-primary btn-inline btn-lg">Add</button>
                    <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewMenuCompany" style="width:25%; margin-right:24%;" class="btn btn-danger btn-inline btn-lg ml-auto">Back to Menu</a>
               
                </form>
          </div>
     </section>

     <script>
        var today = new Date();

        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) { dd = '0' + dd; }
        if (mm < 10) { mm = '0' + mm; } 

        today = yyyy + '-' + mm + '-' + dd;
        publishedDate=  document.getElementById("publishedDate").setAttribute("min", today);
        finishDate=  document.getElementById("finishDate").setAttribute("min", today);
     </script>
     
</main>
<?php require_once('footer.php'); ?>
