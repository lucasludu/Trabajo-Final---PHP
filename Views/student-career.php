<?php require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Personal Information</h1>
            </div>
            <table class="table table-success table-striped">
                <thead>
                    <th>CareerId</th>
                    <th>Description</th>
                    <th>Active</th>
                </thead>
                <tbody> 
                    <?php if(isset($_SESSION['loggedCareer'])) {?>
                        <tr>
                            <td><?php echo $_SESSION['loggedCareer']->getCareerId(); ?></td>
                            <td><?php echo $_SESSION['loggedCareer']->getDescription(); ?></td>
                            <td><?php echo $_SESSION['loggedCareer']->getActive(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php require_once('footer.php'); ?>