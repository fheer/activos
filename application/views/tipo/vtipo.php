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
if (empty($opciones)){
	redirect(base_url()."Chome/");
}
?>
<div class="col-md-10">
	<div class="content-box-large">
		<?php
		if (!empty($mensaje)) {
			?>
			<div class="alert alert-danger alert-dismissible col-md-6 control-label" align="center">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-ban"></i><?php echo $mensaje; ?>
			</div>
			<?php
		}
		?>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<?php echo form_open_multipart(base_url() . 'tipo/CTipoActivo/add', array("class" => "form-horizontal")); ?>
					<div class="form-group">
						<label for="cargo" class="col-md-5 control-label"><span class="text-danger">*</span>
							Nombre Tipo Activo Fijo</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm" name="tipo" id="tipo"
								   value="<?php echo $this->input->post('tipo'); ?>"/>
							<span class="text-danger"><?php echo form_error('tipo'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="cargo" class="col-md-5 control-label"><span class="text-danger">*</span>
							Vida Util</label>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="vidautil" id="vidautil"
								   value="<?php echo $this->input->post('vidautil'); ?>"/>
							<span class="text-danger"><?php echo form_error('vidautil'); ?></span>
						</div>
					</div>
					<div class="box-footer">
						<a href="<?php echo base_url(); ?>tipo/CTipoActivo/"
						   class="btn btn btn-default btn-md pull-right">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
						</a>
						<button type="submit" class="btn btn-info btn-md"><span
								class="glyphicon glyphicon-ok-circle"></span> Guardar
						</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>


