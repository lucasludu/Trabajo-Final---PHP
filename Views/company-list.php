<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Company List</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                         <th>Id</th>
                         <th>Cuit</th>
                         <th>Name</th>
                         <th>Action</th>
                    </thead>
                    <tbody> 
                         <?php foreach($companyList as $company) { ?>
                              <tr>
                                   <td><?php echo $company->getCompanyId(); ?></td>
                                   <td><?php echo $company->getCompanyCuit(); ?></td>
                                   <td><?php echo $company->getCompanyName(); ?></td>
                                   <td>
                                        <a type="submit" href="<?php echo FRONT_ROOT ?>Company/ShowListView2/<?php echo $company->getCompanyId() ?>" class="btn btn-success p-auto">Show</a>
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
