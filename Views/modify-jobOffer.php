<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
            <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Modify User List</h1>
               </div>
               <table class="table table-success table-striped">
                    <thead>
                         <tr>
                            <th>Job Offer Id</th>
                            <th>Published Date</th>
                            <th>Finish Date</th>
                            <th>Task</th>
                            <th>Skills</th>
                            <th>Salary</th>
                            <th>Job Position</th>
                            <th>Company ID</th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr class="table-secondary">
                              <td><?php echo $_SESSION['loggedJobOffer']->getJobOfferId() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getPublishedDate() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getFinishDate() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getTask() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getSkills() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getSalary() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getJobPosition() ?></td>
                              <td><?php echo $_SESSION['loggedJobOffer']->getCompanyId() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Add Job Offer</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>JobOffer/ModifyJobOffer" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-transparent text-primary border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">          
                        <input type="hidden" name="jobOfferId" value="<?php echo $_SESSION['loggedJobOffer']->getJobOfferId()?>">               
                        <div class="col-lg-5 mb-3">
                            <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:35%; font-weight:bolder;">Company</label>
                                <select name="companyName" class="form-control" style="width:65%" aria-label="Default select example" required>
                                    <?php  foreach($companyList as $value) { ?>
                                        <option value="<?php echo $value->getCompanyName() ?>">
                                            <?php echo $value->getCompanyName() ?>
                                        </option>
                                    <?php } ?>
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
                                    <input type="date" name="finishDate" id="finishDate" class="form-control" style="width:65%" required>
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
                                        <option value="<?php echo $value->getDescription() ?>">
                                            <?php echo $value->getDescription() ?>
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
                                        <option value="<?php echo $value->getDescription() ?>">
                                            <?php echo $value->getDescription() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="button" style="width:25%; margin-left:8%;" class="btn btn-primary btn-inline btn-lg">Add</button>
                    <a href="<?php echo FRONT_ROOT ?>Job/LogoutMenuJob" style="width:25%; margin-right:26%;" class="btn btn-danger btn-inline btn-lg ml-auto">Back to Menu</a>
               
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
        document.getElementById("publishedDate").setAttribute("min", today);
     </script>
</main>
<?php require_once('footer.php'); ?>
