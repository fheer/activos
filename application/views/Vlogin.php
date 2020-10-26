<!DOCTYPE html>
<html>
  <head>
    <title>Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo base_url();?>/assets/css/styles.css" rel="stylesheet">

  </head>
  <body class="login-bg">
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Iniciar sesión</h6>
			                <div class="social">                           
	                                <span class="face_icon">
	                                    <img src="<?php echo base_url();?>assets/images/logo.png" alt="Incos" width="210" height="240">
	                                </span>
	                        </div>
	                        <br>
	                        <div align="center">
						      <?php
						        if (isset($mensaje)){
						          echo '<span class="label label-danger">'.$mensaje.'</span>'; 
						          echo '<br><br>';
						        } 
						      ?>
						    </div>
	                        <form action="<?php echo base_url();?>Clogin/ingresar" method="post">
	                        	<input class="form-control" type="text" name="user" placeholder="Correo Electrónico" maxlength="20">
				                <input class="form-control" type="password" name="psw" placeholder="Contraseña" maxlength="60">
				                <div class="action">
				                    <!-- <a class="" href="index.html">Ingresar</a>-->
				                    <button type="submit" class="btn btn-primary signup">Ingresar</button>
				                </div>                
	                        </form>			                
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/custom.js"></script>
  </body>
</html>