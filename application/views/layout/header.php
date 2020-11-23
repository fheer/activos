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

	<link href="<?php echo base_url();?>assets/vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/vendors/select/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

	<link href="<?php echo base_url();?>assets/css/forms.css" rel="stylesheet">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
	<!-- slider -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-slider/slider.css">
	<!-- lte -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/css/admin.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
									<li><a href="<?php echo base_url();?>perfil/CPerfil">Perfil</a></li>
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
							<i class="fa fa-male"></i> Personal
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
							<i class="fa fa-desktop"></i> Activos Fijos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/insertActivo">Alta</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/insertActivo">Baja</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/insertActivo">Transferencia</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/">Lista</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a href="">
							<i class="glyphicon glyphicon-list"></i> Movimientos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>movimientos/CMovimiento/listaLugares/1">Ver Lugares</a></li>
							<li><a href="<?php echo base_url();?>asignar/CAsignar/asignar/">Asignar</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/ver/Ele-123">Ver</a></li>
						</ul>
					</li>

					<li class="submenu">
						<a href="#">
							<i class="fa fa-users"></i> Usuarios
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>usuarios/Cusuario">Lista Usuarios</a></li>
						</ul>
					</li>

					<li class="submenu">
						<a href="#">
							<i class="fa fa-file-o"></i> Reportes
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>reportes/CEntrega/ver_actas">Actas</a></li>
						</ul>
					</li>

					<li class="submenu">
						<a href="#">
							<i class="fa fa-gears"></i> Opciones
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>cargo/CCargo/">Cargos</a></li>
						</ul>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>departamento/CDepartamento/">Departamentos</a></li>
						</ul>
					</li>
					<br><br><br><br><br><br><br><br><br><br>
				</ul>
			</div>
		</div>

		<?php if(empty($this->session->userdata('s_logueado'))) : ?>

			<script>
				$(document).ready(function(){
					$("#modalInicio").modal("show");
				});
			</script>
		<?php endif; ?>
		<!-- Modal -->
		<div class="modal fade" id="modalInicio" data-backdrop="static" data-keyboard="false" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Autenticación</h6>
					</div>
					<div class="modal-body">
						<h5 align="center">No se identifico como Usuario</h5>
					</div>
					<div class="modal-footer">
						<?php echo form_open(base_url()."Clogin"); ?>
						<button type="submit" class="btn btn-success center-block">Aceptar</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>



