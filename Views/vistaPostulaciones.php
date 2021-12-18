<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Job List</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                         <th>jobPositionId</th>
                         <th>careerId</th>
                         <th>description</th>
                    </thead>
                    <tbody> 
                         <?php foreach($jobList as $job) { ?>
                              <tr>
                                   <td><?php echo $job->getJobPositionId(); ?></td>
                                   <td><?php echo $job->getCareerId(); ?></td>
                                   <td><?php echo $job->getDescription(); ?></td>
                                   <td>
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
