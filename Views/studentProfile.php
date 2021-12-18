<?php require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Personal Information</h1>
            </div>
            <table class="table table-info">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Filename</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?php echo $_SESSION['loggedStudent']->getCareerId() ?></th>
                        <td><?php echo $_SESSION['loggedStudent']->getLastName() . ", " . $_SESSION['loggedStudent']->getFirstName() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getDni() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getFileNumber() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getGender() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getBirthDate() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getPhoneNumber() ?></td>
                        <td><?php echo $_SESSION['loggedStudent']->getEmail() ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="<?php echo FRONT_ROOT ?>Home/Logout4" style="width:49%" class="btn btn-danger btn-inline btn-lg">Back to Menu</a>
            <button type="submit" name="button" id="postulate" class="btn btn-primary btn-inline ml-auto btn-lg">Show Postulation</button>
            <script>
                $(document).ready(function() {
                    $("#postulate").click(function() {
                        $("#con1").slideToggle("fast", function() {});
                    });
                });
            </script>
            <div id="con1">
                <table class="table table-success table-striped">
                        <thead>
                            <th>jobPositionId</th>
                            <th>careerId</th>
                            <th>description</th>
                        </thead>
                        <tbody> 
                            <?php if(!isset($_SESSION['loggedJob'])) {?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } else {?>
                                <tr>
                                    <td><?php echo $_SESSION['loggedJob']->getJobPositionId(); ?></td>
                                    <td><?php echo $_SESSION['loggedJob']->getCareerId(); ?></td>
                                    <td><?php echo $_SESSION['loggedJob']->getDescription(); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<?php require_once('footer.php'); ?>