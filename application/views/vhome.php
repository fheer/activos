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
<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<section class="content">
				<div class="row">
					<div class="col-md-6">
						<div class="content-box-large">
							<div class="panel-heading">
								<div class="form-group col-sm-6">
									<img src="<?php echo base_url().'fotos/personas/'.$persona['foto'];?>" width="60" height="80">
									<br><br>
									<h5>
										<strong><?php echo $persona['apellidoPaterno'].' '.$persona['apellidoMaterno'].' '.$persona['nombres']; ?></php></strong>
										<br>
										<?php echo $cargoNombre['cargo']; ?>
									</h5>
								</div>
							</div>
							<div class="panel-body">
								<form class="form-horizontal" role="form">
									<div class="form-group pull-left col-sm-6">
										<label>
											C.I.: <br><?php echo $persona['ci']; ?> <?php echo $persona['expedido']; ?>
											<br>
											Dirección:<br> <?php echo $persona['direccion']; ?>
											<br>
											Telefono: <br><?php echo $persona['telefono']; ?>
											<br>
											E-mail: <br><?php echo $persona['email']; ?>
											<br>
											Departamento: <br><?php echo $dpto['departamento']; ?>
											<br>
										</label>

									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="content-box-large">
							<div class="panel-heading">
								<div class="panel-title"><strong>Opciones</strong></div>
							</div>
							<div class="panel-body">
								<?php echo form_open(base_url().'CPersona/updatePerson/'.$persona['idPersona'],
									array("class"=>"form-inline")); ?>
								<input type="hidden" name="destino" id="destino" value="P">
								<button type="submit" class="btn btn-primary"><i class="fa fa-male"></i>
									Cambiar Datos Personales
								</button>
								<?php echo form_close(); ?>
								<br>
								<?php echo form_open(base_url().'perfil/CPerfil/edit/'.$persona['idPersona'],
									array("class"=>"form-inline")); ?>
								<button type="submit" class="btn btn-primary"><i class="fa fa-user"></i>
									Cambiar Datos Inicio de Sesión
								</button>
								<?php echo form_close(); ?>
								<br>
								<?php echo form_open(base_url().'perfil/CPerfil/liberar/'.$persona['idPersona'],
									array("class"=>"form-inline")); ?>
								<button type="submit" class="btn btn-primary"><i class="fa fa-desktop"></i>
									Ver Activos Fijos Asignados
								</button>
								<?php echo form_close(); ?>
								<br>
								<?php echo form_open(base_url().'perfil/CPerfil/my_actas/'.$persona['idPersona'],
									array("class"=>"form-inline")); ?>
								<button type="submit" class="btn btn-primary"><i class="fa fa-desktop"></i>
									Ver Actas
								</button>
								<?php echo form_close(); ?>
								<br>
								<a href="<?php echo base_url(); ?>reportes/Cfisico/datos_fisico_valorado/<?php echo $persona['idPersona'];?>"
								   class="btn btn-primary" target="_blank"><i class="fa fa-desktop"></i> Físico Valorado</a>

							</div>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
				<br><br><br><br><br><br><br><br>
			</section>
		</div>
	</div>
</div>
</div>
</div>
<?php
if (strtolower($this->session->userdata('s_nuevo')) == 's') :
	?>
	<script>
		$(document).ready(function () {
			$("#modalNuevo").modal("show");
		});
	</script>
<?php endif; ?>
<!-- Modal -->
<div class="modal fade" id="modalNuevo" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Gestión de Activos Fijos</h6>
			</div>
			<div class="modal-body">
				<h5 align="center">Debe cambiar su contraseña por ser la primera ves que inicia sesión</h5>
			</div>
			<div class="modal-footer">
				<?php echo form_open(base_url() . "perfil/CPerfil/change_password/"); ?>
				<button type="submit" class="btn btn-success center-block">Aceptar</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
