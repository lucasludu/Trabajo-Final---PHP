<?php require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Add User</h2>
            <form 
                action="<?php echo FRONT_ROOT ?>User/Add" 
                method="post" 
                class="bg-light-alpha p-5 mb-2 bg-transparent text-white fw-bolder border border-primary row">
                <div class="row" style="margin:0; justify-content:center;">      
                    <div class="col-lg-5 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Firstname</label>
                                <input type="text" name="firstName" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Lastname</label>
                                <input type="text" name="lastName" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Email</label>
                                <input type="email" name="email" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">File Number</label>
                                <input type="number" name="fileNumber" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                              <div class="input-group">
                                    <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Gender</label>
                                   <label class="btn btn-primary p-2  form-control">
                                        <input type="radio" name="gender" id="male" value="Male" style="display:none;">Male
                                   </label>
                                   <label class="btn btn-primary p-2  form-control">
                                        <input type="radio" name="gender" id="male" value="Male" style="display:none;">Famale
                                   </label>
                              </div>
                         </div>
                    <div class="col-lg-5">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Date Birth</label>
                                <input type="date" name="birthDate" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Phone Number</label>
                                <input type="number" name="phoneNumber" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">DNI</label>
                                <input type="number" name="dni" value="" class="form-control">
                        </div>
                    </div>
                    <!--div class="col-lg-5 mb-4">
                        <div class="input-group">
                            <label class="input-group-text bg-info text-dark" style="width:135px; font-weight:bold;">Profile</label>
                            <select name="profile" class="form-control" aria-label="Default select example" required>
                                <option value="Student">Student</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div-->
                </div>
                <button type="submit" name="button" class="btn btn-primary btn-lg ml-auto d-inline">ADD</button>
               <a href="<?php echo FRONT_ROOT ?>Home/Logout5" class="btn btn-danger btn-inline btn-lg ml-5">Back to Menu</a>
            </form>
        </div>
    </section>
</main>
<?php require_once('footer.php'); ?>
