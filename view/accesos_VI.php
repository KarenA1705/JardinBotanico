<?php
class accesos_VI
{
    function __construct(){}
 
    function iniciarSesion()
    {
        ?>
       <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
              <!-- Meta, title, CSS, favicons, etc. -->
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="icon" href="imagen.jpeg"  />
              <title>Jardín Botánico </title>

              <!-- Bootstrap -->
            
              <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
              <!-- Font Awesome -->

              <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              <!-- NProgress -->
            
              <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
              <!-- Animate.css -->
              
              <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

              <!-- Custom Theme Style -->
              
              <link href="build/css/custom.min.css" rel="stylesheet">
              <!--style type="text/css">
                .login1{
                  background-image: url('login.jpg');
                  heigh: 100%;
                  width: 100%;
                }
                </style-->
            </head>

            <body  class="login" >
              <!--img src="login.jpg"-->
              <div class="login">
                <a class="hiddenanchor" id="signup"></a>
                <a class="hiddenanchor" id="signin"></a>

                <div class="login_wrapper">
                  <div class="animate form login_form">
                    <section class="login_content">
                      <form action="index.php" method="post">
                        <h1>Login Form</h1>
                        <div class="input-group mb-2">
                          <input type="email" name="correo" class="form-control" placeholder="Correo">
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" name="contrasena" class="form-control" placeholder="contrasena">
                        </div>
                        <div>
                      
                          <button type="submit" class="btn btn-success ">Iniciar Sesi&oacute;n</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                          <p class="change_link">Aun no tienes cuenta
                            <a href="#signup" class="to_register"> Registrate </a>
                          </p>

                          <div class="clearfix"></div>
                          <br />

                          <div>
                              <h1><i class="fa fa-leaf  "></i> Jardín Botánico</h1>
                              <p>Jardín Botánico Jorge Enrique Quintero Arenas</p>
                            
                          </div>
                        </div>
                      </form>
                    </section>
                  </div>

                  <div id="register" class="animate form registration_form">
                    <section class="login_content">
                      <form>
                        <h1>Create Account</h1>
                        <div>
                          <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                          <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                          <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                          <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                          <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                          </p>

                          <div class="clearfix"></div>
                          <br />

                          <div>
                          <h1><i class="fa fa-leaf  "></i> Jardín Botánico</h1>
                              <p>Jardín Botánico Jorje Enrique Quintero Arenas</p>
                          </div>
                        </div>
                      </form>
                    </section>
                  </div>
                </div>
              </div>
            </body>
          </html>

        <?php
      
    }
 
  
}
?>
    
 

