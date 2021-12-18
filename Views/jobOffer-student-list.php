<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('header.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Jobs Offer</h2>
            
                <table class="table table-success table-stripe">
                    <thead>
                    <tr>
                        <th>Company</th>
                        <th>Descripion</th>
                        <th>Salary</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
               
                        <?php foreach($jobOfferList as $value)     {   ?>
                        <form action="<?php echo FRONT_ROOT ?>Appoitment/showAddView" method="post">
                    <tr>
                    <input type="hidden" name="jobOfferId" value="<?php echo $value['jobOfferId'] ?>">
                        
                    <td><?php echo $value['companyName'] ?></td>
                        <input type="hidden" name="companyName" value="<?php echo $value['companyName'] ?>">
                       
                        <td><?php echo $value['description'] ?></td>
                        <input type="hidden" name="job" value="<?php echo  $value['description'] ?>">
                       
                        <td><?php echo $value['salary'] ?></td>
                       <td><button type="submit"  class="btn" value="Postulation">Postulate</button></td>
                        </form>
                    </tr>
                    <?php                              
                        }
                    ?>
                </tbody>
                </table>
                <a href="<?php echo FRONT_ROOT ?>Home/Logout4" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
            
        </div>
        
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."index.php");
    }
?>