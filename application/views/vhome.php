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
					<div class="col-md-10">
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
								<div class="info-box-content">
									<span><?php echo $countPersona; ?></span>
									<span class="info-box-text">Personal</span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>Cpersona" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<?php
						 if (!empty($activos)) {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-success"><i class="ion ion-android-laptop"></i></span>
								<div class="info-box-content">
									<span class=""><?php echo $countActivo; ?></span>
									<span class="info-box-text">Activos </span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>activos/Cactivofijo" target="_blank" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<?php
						}
						?>
						<?php
						if (!empty($movimientos)) {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-blue-active"><i class="ion ion-arrow-swap"></i></span>
								<div class="info-box-content">
									<span class="ion ion-ios-desktop-outline"></span>
									<span class="info-box-text">Movimientos</span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>Cpersona" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
							<?php
						}
						?>
						<?php
						if (!empty($usuarios)) {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-light-blue-active"><i class="ion ion-android-contact"></i></span>
								<div class="info-box-content">
									<span ><?php echo $countUsuario; ?></span>
									<span class="info-box-text">Usuarios </span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>Cpersona" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<?php
						}
						?>
						<?php
						if (!empty($reportes)) {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-red-active"><i class="ion ion-android-print"></i></span>
								<div class="info-box-content">
									<span class="ion ion-ios-desktop-outline"></span>
									<span class="info-box-text">Reportes</span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>Cpersona" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
							<?php
						}
						?>
						<?php
						if (!empty($opciones)) {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="info-box">
								<span class="info-box-icon bg-gray-active"><i class="ion ion-ios-gear"></i></span>
								<div class="info-box-content">
									<span class="ion ion-ios-desktop-outline"></span>
									<span class="info-box-text">Opciones</span>
									<span class="info-box-number">
												<a href="<?php echo base_url(); ?>Cpersona" class="small-box-footer">Mostrar <i
														class="fa fa-arrow-circle-right"></i></a>
											</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
					</div>
					<?php
					}
					?>
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
