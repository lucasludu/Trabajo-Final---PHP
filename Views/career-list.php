<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Career List</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                         <th>Career Id</th>
                         <th>Description</th>
                         <th>Active</th>
                    </thead>
                    <tbody class="table-info"> 
                         <?php foreach($careerListpdo as $careerPdo) { ?>
                              <tr>
                                   <td><?php echo $careerPdo->getCareerId(); ?></td>
                                   <td><?php echo $careerPdo->getDescription(); ?></td>
                                   <td><?php echo $careerPdo->getActive(); ?></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
               <a href="<?php echo FRONT_ROOT ?>Career/ShowProfileCareerView" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
