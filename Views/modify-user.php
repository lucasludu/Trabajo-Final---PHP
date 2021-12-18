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
                              <th>Email</th>
                              <th>Password</th>
                              <th>Profile</th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr class="table-secondary">
                              <td><?php echo $_SESSION['loggedUser']->getEmail() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getPassword() ?></td>
                              <td><?php echo $_SESSION['loggedUser']->getProfile() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Modify Company</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>User/ModifyUser" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-secondary text-white fw-bolder border border-primary row">
                    <div class="row">  
                         <div class="col-lg-10 mb-3">
                                <div class="input-group">
                                    <label class="input-group-text" style="width:20%;">Email</label>
                                    <input type="email" name="email" value="<?php echo $_SESSION['loggedUser']->getEmail() ?>" class="form-control">
                                </div>
                         </div>
                         <div class="col-lg-10 mb-3">
                                <div class="input-group">
                                    <label class="input-group-text" style="width:20%;">Password</label>
                                    <input type="password" name="password" value="<?php echo $_SESSION['loggedUser']->getPassword() ?>" class="form-control">
                                </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-primary ml-0 d-inline">Modificar</button>
                    <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin" class="btn btn-danger btn-inline ml-3 btn-lg">Back to Menu</a>
               </form>
          </div>
    </section>
</main>
<?php 
  include_once('footer.php');
?>