<?php require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="bg-body mx-0 w-50">
                    <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Add Company</h1>
               </div>
               <form 
                    action="<?php echo FRONT_ROOT ?>Company/Add" 
                    method="post" 
                    class="bg-light-alpha p-5 mb-2 bg-transparent text-primary border border-primary row">
                    <div class="row" style="margin:0; justify-content:center;">                         
                         <div class="col-lg-10 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:14%; font-weight:bolder;">Name</label>
                                   <input type="text" name="companyName" value="" class="form-control" style="width:86%;" required>
                              </div>
                         </div>
                         <div class="col-lg-5 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:29%; font-weight:bolder;">Cuit</label>
                                   <input type="number" name="cuit" value="" length="11" placeholder="" min= "00000000000" max="99999999999"  style="width:70%;" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-5">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:29%; font-weight:bolder;">City</label>
                                   <input type="text" name="companyCity" value="" style="width:71%;" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-5">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:29%; font-weight:bolder;">Email</label>
                                   <input type="email" name="companyEmail" style="width:71%;" value="" class="form-control"required>
                              </div>
                         </div>
                         <div class="col-lg-5 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:29%; font-weight:bolder;">Phone</label>
                                   <input type="text" name="companyPhoneNumber" style="width:71%;" value="" class="form-control"required>
                              </div>
                         </div>
                         <div class="col-lg-10 mb-3">
                              <div class="input-group">
                                   <label class="input-group-text bg-info text-dark" style="width:14%; font-weight:bolder;">Description</label>
                                   <textarea name="companyDescription" style="width:86%;"></textarea>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-primary btn-inline ml-auto btn-lg">Add</button>
                    <a href="<?php echo FRONT_ROOT ?>Home/Logout3" class="btn btn-danger btn-inline btn-lg ml-5">Back to Menu</a>

               </form>
          </div>
     </section>
     
</main>
<?php require_once('footer.php'); ?>
