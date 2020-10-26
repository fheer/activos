<?php
if(!$this->session->userdata('s_logueado')){
      $Urlu = base_url()."Clogin";
        echo '<script language="javascript">alert("No se identifico como Usuario");</script>';  
        echo '<script type="text/javascript">window.location="'.$Urlu.'"; </script>';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Activos APP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/calendar.css" rel="stylesheet">

  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-8">
	              <!-- Logo -->
	              <div class="logo">
   	                 <h1><a href="index.html">SIWEAF</a></h1>
	              </div>
	           </div>

	           <div class="col-md-4">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span ><?php echo $this->session->userdata('s_nomUser');?></span> 
                            <b class="caret"></b>
                          </a>
	                        <ul class="dropdown-menu animated fadeInUp">
                            <li></li>
	                          <li><a href="profile.html">Profile</a></li>
	                          <li><a href="<?php echo base_url();?>Clogin/cerrar_sesion">Salir</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href=""><i class="glyphicon glyphicon-home"></i> Menu</a></li>
					<li class="submenu">
						<a href="#">
							<i class="glyphicon glyphicon-list"></i> Personal
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>CPersona">Nuevo</a></li>
							<li><a href="">Lista</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#">
							<i class="glyphicon glyphicon-list"></i> Activos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>CPersona">Nuevo</a></li>
							<li><a href="">Lista</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="#">
							<i class="glyphicon glyphicon-list"></i> Movimientos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>CPersona">Nuevo</a></li>
							<li><a href="">Lista</a></li>
						</ul>
					</li>

                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Usuarios
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="login.html">Lista Usuarios</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
