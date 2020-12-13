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
if (empty($activos)){
	redirect(base_url()."Chome/");
}
?>
<div class="col-md-10">
	<div class="content-box-large">
		<?php
		if (!empty($mensaje))
		{
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $mensaje; ?>
			</div>
			<?php
		}
		?>
		<div class="panel-body">
			<section class="content col-md-8">
				<div class="row">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Baja Activo Fijo</h3>
						</div>
						<div class="box-body">
							<?php echo form_open(base_url().'activos/Cactivofijo/baja',array("class"=>"form-horizontal")); ?>
							<div class="form-group col-md-8">
								<label for="idActivofijo" class="control-label">Activo Fijo</label>
								<br>
								<select id="idActivofijo" name="idActivofijo[]" class="col-md-6 form-control select2" multiple="multiple">
									<?php
									foreach ($activo as $row)
									{
									?>
										<option value="<?php echo $row['idActivofijo']; ?>"><?php echo $row['codigo']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<br>
							<div class="form-group col-md-8">
								<label for="user" class="control-label">Motivo</label>
								<select id="idMotivo" name="idMotivo" class="col-md-6 form-control select2">
									<?php
									foreach ($motivo as $row)
									{
										?>
										<option value="<?php echo $row['idMotivoBaja']; ?>"><?php echo $row['motivo']; ?></option>
										<?php
									}
									?>
								</select>
								<span class="text-danger"><?php echo form_error('motivo');?></span>
							</div>
							<br><br>
							<div class="form-group col-md-6">
								<label for="observaciones" class="control-label">Observaciones</label>
								<textarea id="observaciones" class="form-control col-md-6 " name="observaciones" rows="4">Ninguna</textarea>
								<span class="text-danger"><?php echo form_error('observaciones');?></span>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- Form Element sizes -->
				</div>
				<div class="">
					<button type="submit" class="btn btn-danger btn-md ">
						<span class="glyphicon glyphicon-ok-circle"></span> Dar baja
					</button>
					<a href="<?php echo base_url();?>Chome" class="btn btn btn-default btn-md pull-right">
						<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
					</a>
				</div>
				<?php echo form_close(); ?>
			</section>
		</div>
	</div>
</div>
</div>
</div>

