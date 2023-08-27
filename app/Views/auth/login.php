<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href=" ../public/css/main.css">
    <link rel="stylesheet" href="../public/vendor/animate/animate.css">
    <link rel="stylesheet" href="../public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="../public/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="../public/vendor/daterangepicker/daterangepicker.css">
</head>
<body>
    <div class="limiter">     
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="<?php echo base_url()?>/loggin">
                    <span class="login100-form-title p-b-29">
                        <img src="../public/img/logosiglo21.png" alt="">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input id="email" type="email" class="input100" name="usuario" value="" required autocomplete="email" autofocus>
                        <span class="focus-input100" data-placeholder="Correo"></span>                    
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </span>
                        <input id="password" type="password" class="input100 " name="password" required autocomplete="current-password">
                        <span class="focus-input100" data-placeholder="Contraseña"></span>
                        
                    </div>
                    <?php if (session()->getFlashdata('mensaje')): ?>
                        <div class="alert alert-danger">
                             <?php echo session()->getFlashdata('mensaje'); ?> 
                        </div>
                    <?php endif; ?>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                <b>Iniciar sesión</b>  
                            </button>
                            
                        </div>

                    </div>
                
                </form>
            </div>
        </div>
    </div>
	
</body>

    <!-- Template Main JS File -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../public/js/main.js"></script>
    <script src="../public/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../public/vendor/animsition/js/animsition.min.js"></script>
    <script src="../public/vendor/select2/select2.min.js"></script>
    <script src="../public/vendor/daterangepicker/moment.min.js"></script>
    <script src="../public/vendor/countdowntime/countdowntime.js"></script>
</html>

