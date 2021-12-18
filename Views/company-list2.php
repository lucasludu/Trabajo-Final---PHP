<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Company List</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                         <tr class="table table-success table-striped">
                              <th>Id</th>
                              <th>Name</th>
                              <th>Cuit</th>
                              <th>City</th>
                              <th>Description</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr class="table-secondary">
                              <th><?php echo $_SESSION['loggedUser']->getCompanyId() ?></th>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyName() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyCuit() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyCity() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyDescription() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyEmail() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getCompanyPhoneNumber() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
