<!DOCTYPE html>
<html lang="es">
<head>
	<title>Activos Fijos APP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<!-- jQuery UI -->
	<link href="https://code.jquery.com/ui/1.11.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- styles -->
	<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/stylesbox.css" rel="stylesheet">

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />

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
			<?php
			if (!empty($this->session->userdata('s_idPersona'))){
				$ci = &get_instance();
				$ci->load->model('Persona_model');

				$persona= $ci->Persona_model->get_persona($this->session->userdata('s_idPersona'));
				$nombreCompleto = $persona['apellidoPaterno']. ' '.$persona['apellidoMaterno']. ' '.$persona['nombres']. ' ';
			}
			?>
			<div class="col-md-4">
				<div class="navbar navbar-inverse" role="banner">
					<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span style="color:#123f8d"><?php if (!empty($nombreCompleto))echo $nombreCompleto;?></span>
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
				<?php
				if (!empty($this->session->userdata('s_idUsuario'))) {
					$ciU = &get_instance();
					$ciU->load->model('Usuario_model');
					$ciU->load->model('Persona_model');

					$usuario = $ciU->Usuario_model->get_usuario($this->session->userdata('s_idUsuario'));
					$permisos = explode("#",$usuario['permiso']);
					$espacios = count($permisos);
					$personalMd5 = md5("Personal");
					$activosFijosMd5 = md5("Activos");
					$movimientosMd5 = md5("Movimientos");
					$usuariosMd5 = md5("Usuarios");
					$reportesMd5 = md5("Reportes");
					$opcionesMd5 = md5("Opciones");
					$perfilMd5 = md5("Perfil");

					foreach ($permisos as $permisoMd5)
					{
						switch ($permisoMd5)
						{
							case $perfilMd5:
								$perfil = "Perfil";
								break;
							case $personalMd5:
								$personal = "Personal";
								break;
							case $activosFijosMd5:
								$activos = "Activos";
								break;
							case $movimientosMd5:
								$movimientos = "Movimientos";
								break;
							case $usuariosMd5:
								$usuarios = "Usuarios";
								break;
							case $reportesMd5:
								$reportes = "Reportes";
								break;
							case $opcionesMd5:
								$opciones = "Opciones";
								break;
						}
					}
				}
				?>
				<ul class="nav">
					<!-- Main menu -->
					<li><a href=""><i class="glyphicon glyphicon-home"></i> Menu</a></li>
					<?php
						if (!empty($perfil))
						{
					?>
					<li class="submenu">
						<a href="#">
							<i class="fa fa-user-secret"></i> Perfil
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>perfil/CPerfil">Ver Perfil</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<?php
					if (!empty($personal))
					{
						?>
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
					<?php
					}
					?>
					<?php
					if (!empty($activos))
					{
						?>
					<li class="submenu">
						<a href="#">
							<i class="fa fa-desktop"></i> Activos Fijos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/insertActivo">Alta</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/baja_activo">Baja</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/">Lista Activos Fijos</a></li>
							<li><a href="<?php echo base_url();?>activos/Cactivofijo/list_bajas">Lista Bajas</a></li>
							<li><a href="<?php echo base_url();?>reportes/CEtiquetas/print_all_labels" target="_blank">Imprimir Etiquetas</a></li>
							<li><a href="<?php echo base_url(); ?>reportes/CfisicoAll/datos_fisico_valorado" target="_blank">Fisico Valorado</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<?php
					if (!empty($movimientos))
					{
						?>
					<li class="submenu">
						<a href="">
							<i class="fa  fa-arrows-h"></i> Movimientos
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>asignar/CAsignar/asignar/">Asignar</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<?php
					if (!empty($usuarios))
					{
						?>
					<li class="submenu">
						<a href="#">
							<i class="fa fa-users"></i> Usuarios
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>usuarios/CUsuario">Lista Usuarios</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<?php
					if (!empty($reportes))
					{
						?>
					<li class="submenu">
						<a href="#">
							<i class="fa fa-print"></i> Reportes
							<span class="caret pull-right"></span>
						</a>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>reportes/CEntrega/ver_actas">Actas</a></li>
						</ul>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>etiqueta/CEtiqueta/">Etiquetas</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<?php
					if (!empty($opciones))
					{
						?>
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
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>estado/CEstado/">Estado</a></li>
						</ul>
						<!-- Sub menu -->
						<ul>
							<li><a href="<?php echo base_url();?>tipo/CTipoActivo/">Tipo Activo Fijo</a></li>
						</ul>

					</li>
					<?php
					}
					?>
					<?php
					if (!empty($espacios))
					{
						switch ($espacios)
						{
							case 1:
								echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
								break;
							case 2:
								echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
								break;
							case 3:
								echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
								break;
							case 4:
								echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
								break;
							case 5:
								echo "<br><br><br><br><br><br><br><br><br><br>";
								break;
							case 6:
								echo "<br><br><br><br><br><br><br>";
								break;
							case 7:
								echo "<br><br><br><br><br>";
								break;
							case 8:
								echo "<br><br>";
								break;
						}
					}

					?>
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



