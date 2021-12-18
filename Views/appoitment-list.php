<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('header.php');
?><main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="bg-body mx-0 w-50">
                <h1 class="font-monospace mb-4" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">List Appoitnment</h1>
            </div>
               <table class="table table-success table-striped">
                    <thead>
                <tr>
                        <th>Company</th>
                        <th>Job Position</th>
                        <th>Email</th>
                        <th>Messagge</th>
                        <th>CV</th>
                </tr>
                </thead>
                <tbody class="table-info">
                    <?php foreach($appoitmentList as $value) { ?>
                        <tr>
                            <td><?php echo $value['companyName'] ?></td>
                            <td><?php echo $value['description'] ?></td>
                            <td><?php echo $value['email'] ?></td> 
                            <td><?php echo $value['message'] ?></td> 
                            <td> <a href="<?php echo FRONT_ROOT ?>Appoitment/ShowFile?name=<?php echo $value['cv']?>">Show</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="<?php echo FRONT_ROOT ?>Student/ShowProfileView" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."index.php");
    }
?>