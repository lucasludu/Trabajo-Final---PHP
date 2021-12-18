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
                              <th>Job Position Id</th>
                              <th>Career ID</th>
                              <th>Description</th>
                         </tr>
                    </thead>
                    <tbody>
                         <tr class="table-secondary">
                              <td><?php echo $_SESSION['loggedJob']->getJobPositionId() ?></td>
                              <td><?php echo $_SESSION['loggedJob']->getCareerId() ?></td>
                              <td><?php echo $_SESSION['loggedJob']->getDescription() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Modify Company</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>Job/ModifyJob" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-secondary text-white fw-bolder border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">  
                         <input type="hidden" name="jobPositionId" value="<?php echo $_SESSION['loggedJob']->getJobPositionId()?>">                       
                         <div class="col-lg-10 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:20%; font-weight:bolder;">Description</label>
                                   <input type="text" name="description" value="<?php echo $_SESSION['loggedJob']->getDescription() ?>" class="form-control" style="width:400px" required>
                              </div>
                         </div>
                         <div class="col-lg-10 mb-5">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:20%; font-weight:bolder;">Career Id</label>
                                   <select class="form-select" name="careerId" style="width:80%" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="-">-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
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