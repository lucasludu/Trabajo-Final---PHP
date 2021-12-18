<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('header.php');
?><main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Company</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                         <th>Email</th>


                         <th>Action</th>
                    </thead>
                    <tbody class="table-info"> 
                         <?php foreach($arrayCompany as $company) { ?>
                              <tr>
                                   <td><?php echo $_SESSION['loggedUser']->getEmail(); ?></td>

                                   <td>
                                   <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>Company/ShowModifyView/<?php echo $company->getCompanyId(); ?>" class="btn btn-success p-auto">Edit</a>
                                   <a type="submit" href="<?php echo FRONT_ROOT ?>Company/DeleteCompany1/<?php echo $company->getCompanyCuit(); ?>" class="btn btn-danger p-auto">Baja</a> 
                                        <a type="submit" href="<?php echo FRONT_ROOT ?>Company/ShowListView22/<?php echo $company->getCompanyId() ?>" class="btn btn-success p-auto">Show</a>
                                        <a href="<?php echo FRONT_ROOT?>JobOffer/ShowAddView2" class="btn btn-primary px-5" aria-current="page">Add JobOffer</a>
                                        <a href="<?php echo FRONT_ROOT?>JobOffer/ShowProfileView2" class="btn btn-primary px-5" aria-current="page">List JobOffer</a>



                                   </td>
                              </tr>
                              <?php } ?>
                    </tbody>
               </table>
               <a href="<?php echo FRONT_ROOT ?>Home/Index" class="btn btn-danger btn-inline mx-auto btn-lg">Back to Menu</a>
          </div>
     </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."Index.php");
    }
?>