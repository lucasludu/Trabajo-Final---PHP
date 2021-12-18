<?php  require_once('header.php'); ?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container-fluid">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-info">
                    <?php foreach($appoitmentList as $value) { ?>
                        <tr>
                            <td><?php echo $value['companyName'] ?></td>
                            <td><?php echo $value['description'] ?></td>
                            <td><?php echo $value['email'] ?></td> 
                            <td><?php echo $value['message'] ?></td> 
                            <td> <a href=" <?php echo FRONT_ROOT ?>Appoitment/ShowFile?name=<?php echo $value['cv']?>">Show</a></td>
                            <td>
                            <a href=" <?php echo FRONT_ROOT ?>Appoitment/ShowDownload?name=<?php echo $value['cv']?>">Descargar</a>
                            <a class="btn btn-danger" href=" <?php echo FRONT_ROOT ?>Company/showSendEmail">Send Email</a>

                                <a type="submit" href="" class="btn btn-danger p-auto">Delete</a> 
                                <a type="submit" href="../Views/ExcelAppoitment.php" class="btn btn-danger p-auto">Excel</a> 
                                <a type="submit" href="../Views/ExcelAppoitment.php" class="btn btn-danger p-auto">Excel</a> 
                                

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="<?php echo FRONT_ROOT ?>Appoitment/ShowProfileAppoitmentView" class="btn btn-danger btn-block btn-lg">Back to Menu</a>
        </div>
    </section>