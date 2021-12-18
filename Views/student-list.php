<?php if(isset($_SESSION['loggedUser'])) { require_once('header.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container-fluid bg-white border border-white">
               <!--div class="bg-body mx-0 w-50 position-relative">
                    <h1 class="font-monospace mb-4 position-absolute bottom-50 end-50" style="font-family: myFuente; font-size: 40px; font-weight: bold; color:red;">Student List</h1>
               </div>
               <form action="<!?php echo FRONT_ROOT ?>Student/SearchFilter" method="post">
                    <div class="input-group mb-3">
                         <input type="text" name="lastname" class="form-control" style="width:80%" placeholder="Ingrese apellido del estudiante a buscar" aria-label="" aria-describedby="basic-addon2">
                         <button class="btn btn-primary btn-sm" style="width:20%" type="submit">Buscar</button>
                    </div>
               </form-->
               <table class="table table-success table-striped" id="myTable">
                    <thead class="bg-dark text-white">
                         <th>Student ID</th>
                         <th>Career ID</th>
                         <th>Name</th>
                         <th>Dni</th>
                         <th>File Number</th>
                         <th>Gender</th>
                         <th>Birth Date</th>
                         <th>Email</th>
                         <th>Phone Number</th>
                         <th>Active</th>
                    </thead>
                    <tbody class="table-info"> 
                         <?php foreach($studentListapi as $student) { ?>
                              <tr>
                                   <td><?php echo $student->getStudentId(); ?></td>
                                   <td><a class="btn btn-primary" role="button" target="_blank" name="button" href="<?php echo FRONT_ROOT ?>Career/ShowPersonalCareer/<?php echo $student->getCareerId() ?>"><?php echo $student->getCareerId(); ?></a></td>
                                   <td><?php echo $student->getLastName() . ", " . $student->getFirstName(); ?></td>
                                   <td><?php echo $student->getDni(); ?></td>
                                   <td><?php echo $student->getFileNumber(); ?></td>
                                   <td><?php echo $student->getGender(); ?></td>
                                   <td><?php echo $student->getBirthDate(); ?></td>
                                   <td><?php echo $student->getEmail(); ?></td>
                                   <td><?php echo $student->getPhoneNumber(); ?></td>
                                   <td><?php echo $student->getActive(); ?></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
               <a href="<?php echo FRONT_ROOT ?>Home/Logout5" class="btn btn-danger btn-block btn-lg">Volver al menu</a>
          </div>
     </section>
</main>
<?php require_once('footer.php'); ?>
<?php } else { require_once(VIEWS_PATH."index.php"); } ?>