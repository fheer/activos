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
	<title>Activos Fijos APP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery UI -->
	<link href="https://code.jquery.com/ui/1.11.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
	<!-- slider -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-slider/slider.css">
	<!-- lte -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/css/admin.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
<div class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<!-- Logo -->
				<div class="logo">
					<h1><a href="">Gestión de Activos Fijos</a></h1>
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
							<li><a href="<?php echo base_url();?>CPersona/insertPerson">Nuevo</a></li>
							<li><a href="<?php echo base_url();?>CPersona">Lista</a></li>
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
					<br><br><br><br><br><br><br><br><br><br>
				</ul>
			</div>
		</div>
