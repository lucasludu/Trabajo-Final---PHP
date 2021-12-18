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
                    <tbody>
                         <tr class="table-secondary">
                              <td><?php echo $_SESSION['loggedCareer']->getCareerId() ?></td>
                              <td><?php echo $_SESSION['loggedCareer']->getDescription() ?></td>
                              <td><?php echo $_SESSION['loggedCareer']->getActive() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Modify Career</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>Career/ModifyCareer" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-secondary text-white fw-bolder border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">   
                    <input type="hidden" name="careerId" value="<?php echo $_SESSION['loggedCareer']->getCareerId()?>">
                    <div class="col-lg-10 mb-3">
                        <div class="input-group">
                            <label class="input-group-text bg-info text-dark" style="width:20%; font-weight:bolder;">Description</label>
                            <input type="text" name="description" value="<?php echo $_SESSION['loggedCareer']->getDescription() ?>" class="form-control" style="width:80%" required>
                        </div>
                    </div>
                    <div class="col-lg-10 mb-3">
                        <div class="input-group">
                            <label class="input-group-text bg-info text-dark" style="width:20%; font-weight:bolder;">Active</label>
                            <select class="form-select"  name="active" aria-label="Default select example" style="width:80%;" required>
                                <option selected>Open this select career Active</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <button type="submit" name="button" class="btn btn-primary ml-0 d-inline">Modify</button>
                    <a href="<?php echo FRONT_ROOT ?>Company/ShowListViewAdmin" class="btn btn-danger btn-inline ml-3 btn-lg">Back to Menu</a>
               </form>
          </div>
    </section>
</main>
<?php 
  include_once('footer.php');
?>