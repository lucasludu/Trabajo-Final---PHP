<?php if(isset($_SESSION['loggedUser'])) { require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Job Position List</h1>
          </div>
               <table class="table table-success table-striped" id="mytable">
                    <thead>
                         <th>jobPositionId</th>
                         <th>careerId</th>
                         <th>description</th>
                         <th>Action</th>
                    </thead>
                    <tbody> 
                         <?php foreach($jobListApi as $jobApi) { ?>
                              <tr>
                                   <td><?php echo $jobApi->getJobPositionId(); ?></td>
                                   <td><?php echo $jobApi->getCareerId(); ?></td>
                                   <td><?php echo $jobApi->getDescription(); ?></td>
                                   <td>
                                        <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>Student/ShowJobPostulate/<?php echo $jobApi->getJobPositionId(); ?>" class="btn btn-success p-auto">Postulate</a>
                                   </td>
                              </tr>
                         <?php } ?>
                    </tbody> 
                    <tbody class="table-info"> 
                         <?php foreach($jobListPdo as $jobBD) { ?>
                              <tr>
                                   <td><?php echo $jobBD->getJobPositionId(); ?></td>
                                   <td><?php echo $jobBD->getCareerId(); ?></td>
                                   <td><?php echo $jobBD->getDescription(); ?></td>
                                   <td>
                                        <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>Student/ShowJobPostulate/<?php echo $jobBD->getJobPositionId(); ?>" class="btn btn-success p-auto">Postulate</a>
                                   </td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
               <a href="<?php echo FRONT_ROOT ?>Home/Logout4" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
<?php } else { require_once(VIEWS_PATH."index.php"); } ?>