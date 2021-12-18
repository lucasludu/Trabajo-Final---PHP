<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Job List User</h1>
          </div>
               <table class="table table-success table-striped">
                    <thead>
                         <th>Email</th>
                         <th>Password</th>
                         <th>Profile</th>
                         <th>Action</th>
                    </thead>
                    <tbody class="table-info"> 
                         <?php foreach($userList as $userBD) { ?>
                              <tr>
                                   <td><?php echo $userBD->getEmail(); ?></td>
                                   <td><?php echo $userBD->getPassword(); ?></td>
                                   <td><?php echo $userBD->getProfile(); ?></td>
                                   <td>
                                        <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>User/ShowModifyView/<?php echo $userBD->getEmail(); ?>" class="btn btn-success p-auto">Edit</a>
                                        <a type="submit" name="button" href="<?php echo FRONT_ROOT ?>User/DeleteUser/<?php echo $userBD->getEmail(); ?>" class="btn btn-danger p-auto">Delete</a> 
                                   </td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
               <a href="<?php echo FRONT_ROOT ?>Home/Logout6" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
