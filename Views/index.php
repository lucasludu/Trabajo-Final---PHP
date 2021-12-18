<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login and Register</title>
        <link rel="stylesheet" href="<?php echo CSS_PATH ?>css.css">
    </head>

    <body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>Do you have an account?</h3>
                        <p>
                                Sign In
                        </p>
                        <button id="btn__iniciar-sesion">Login</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>Are you new?</h3>
                        <p>
                        Create an account
                        </p>
                        <button id="btn__registrarse">Sign Up</button>
                    </div>
                </div>
                <div class="contenedor__login-register">
                    <form 
                        action="<?php echo FRONT_ROOT ?>Student/Login" 
                        class="formulario__login">
                            <h2>Login</h2>
                            <input type="text" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="Password">
                            <button name="btnLogin" id="btnLogin" class="btn-block" type="submit">Login</button>
                            <a target="_blank" href="<?php echo FRONT_ROOT ?>User/ShowProfileUserRecovery"><h6>Forgot Password?</h6></a>
                            
                    </form>

                    <form 
                        action="<?php echo FRONT_ROOT ?>User/AddStudent" 
                        class="formulario__register"
                        method="post">
                            <h2>Register</h2>
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="Password">
                            <input class="mb-3" type="text" name="question" placeholder="Ingrese pregunta de seguridad">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Open this select menu</option>
                            <option value="1">Student</option>
                            <option value="2">Company</option>
                            </select>
                            <button name="btnLogin" id="btnLogin" class="btn-block" type="submit">Register</button>
                    </form>
                </div>
            </div>
         </main>
         <script src="<?php echo JS_PATH ?>script.js"></script>
    </body>

</html>