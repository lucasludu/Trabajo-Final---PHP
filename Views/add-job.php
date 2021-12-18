<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Add Job</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>Job/Add" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-transparent text-primary border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">                         
                         <div class="col-lg-10 mb-5">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:17%; font-weight:bolder;">Careers</label>
                                   <select name="careerId" class="form-control" style="width:73%" aria-label="Default select example" required>
                                        <?php  foreach($careerList as $value) { ?>
                                             <option value="<?php echo $value->getDescription() ?>">
                                             <?php echo $value->getDescription() ?>
                                             </option>
                                        <?php } ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-10 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:20%; font-weight:bolder;">Description</label>
                                   <input type="text" name="description" value="" class="form-control" style="width:400px" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" style="width:25%; margin-left:8%;" class="btn btn-primary btn-inline btn-lg">Add</button>
                    <a href="<?php echo FRONT_ROOT ?>Job/LogoutMenuJob" style="width:25%; margin-right:26%;" class="btn btn-danger btn-inline btn-lg ml-auto">Back to Menu</a>
               </form>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
