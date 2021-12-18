<?php require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Recoveri</h2>
            <form 
                action="<?php echo FRONT_ROOT ?>User/PasswordChange" 
                method="post" 
                class="bg-light-alpha p-5 mb-2 bg-transparent text-white fw-bolder border border-primary row">
                <div class="row" style="margin:0; justify-content:center;">      
                    <div class="col-lg-10 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:25%; font-weight:bold;">Email</label>
                                <input type="email" name="email" value="" class="form-control" required>
                        </div>
                        <div class="col-lg-10 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:25%; font-weight:bold;">Enter your new password</label>
                                <input type="password" name="password" value="" class="form-control" required>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-10 mb-3">
                        <div class="input-group">
                                <label class="input-group-text bg-info text-dark" style="width:25%; font-weight:bold;">Enter security answer</label>
                                <input type="text" name="question" value="" class="form-control" required>
                        </div>
                    </div>
                <button type="submit" name="button" class="btn btn-primary btn-lg ml-auto d-inline">Send</button>
               <a href="<?php echo FRONT_ROOT ?>Home/Index" class="btn btn-danger btn-inline btn-lg ml-5">Back to Menu</a>
            </form>
        </div>
    </section>
</main>
<?php require_once('footer.php'); ?>
