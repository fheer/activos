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
if (empty($personal)){
	redirect(base_url()."Chome/");
}
?>
			<div class="col-md-10">
				<div class="content-box-large">
					<?php
					if (!empty($mensaje)) {
						?>
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Mensaje</h4>
							<?php echo $mensaje; ?>
						</div>
						<?php
					}
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-8">
							<?php echo form_open_multipart(base_url().'CPersona/add',array("class"=>"form-horizontal")); ?>
							<div class="form-group">
								<label for="ci" class="col-md-4 control-label"><span class="text-danger">*</span> Ci</label>
								<div class="col-md-3">
									<input type="text" class="form-control input-sm" name="ci" value="<?php echo $this->input->post('ci'); ?>"  id="ci" />
									<span class="text-danger"><?php echo form_error('ci');?></span>
								</div>
								<div class="col-md-2">
									<select name="idExpedido" id="idExpedido" class="form-control">
										<?php foreach($expedido as $row) { ?>
											<option value="<?php echo $row['expedido']; ?>"><?php echo $row['expedido']; ?></option>
										<?php } ?>
									</select>
									<span class="text-danger"><?php echo form_error('cargo');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span> Nombres</label>
								<div class="col-md-4">
									<input type="text" name="nombre" value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
									<span class="text-danger"><?php echo form_error('nombre');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="apellidoPaterno" class="col-md-4 control-label"><span class="text-danger">*</span> Apellido Paterno</label>
								<div class="col-md-5">
									<input type="text" name="apellidoPaterno" value="<?php echo $this->input->post('apellidoPaterno'); ?>" class="form-control" id="apellidoPaterno" />
									<span class="text-danger"><?php echo form_error('apellidoPaterno');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="apellidoMaterno" class="col-md-4 control-label"><span class="text-danger">*</span> Apellido Materno</label>
								<div class="col-md-5">
									<input type="text" name="apellidoMaterno" value="<?php echo $this->input->post('apellidoMaterno'); ?>" class="form-control" id="apellidoMaterno" />
									<span class="text-danger"><?php echo form_error('apellidoMaterno');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="cargo" class="col-md-4 control-label"><span class="text-danger">*</span> Departamento</label>
								<div class="col-md-5">
									<select name="idDepartamento" id="idDepartamento" class="form-control">
										<?php foreach($departamento as $row) { ?>
											<option value="<?php echo $row['idDepartamento']; ?>"><?php echo $row['departamento']; ?></option>
							 			<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="cargo" class="col-md-4 control-label"><span class="text-danger">*</span> Cargo</label>
								<div class="col-md-3">
									<select name="idCargo" id="idCargo" class="form-control">
									<?php foreach($cargo as $row) { ?>
										<option value="<?php echo $row['idCargo']; ?>"><?php echo $row['cargo']; ?></option>
									<?php } ?>
									</select>
										<span class="text-danger"><?php echo form_error('cargo');?></span>
									</div>
							</div>
							<div class="form-group">
								<label for="direccion" class="col-md-4 control-label"><span class="text-danger">*</span> Dirección</label>
								<div class="col-md-6">
									<input type="text" name="direccion" value="<?php echo $this->input->post('direccion'); ?>" class="form-control" id="direccion" />
									<span class="text-danger"><?php echo form_error('direccion');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="telefono" class="col-md-4 control-label"><span class="text-danger">*</span> Telefono</label>
								<div class="col-md-4">
									<input type="text" name="telefono" value="<?php echo $this->input->post('telefono'); ?>" class="form-control" id="telefono" />
									<span class="text-danger"><?php echo form_error('telefono');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-md-4 control-label"><span class="text-danger">*</span> Email</label>
								<div class="col-md-4">
									<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
									<span class="text-danger"><?php echo form_error('email');?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="archivo" class="col-md-4 control-label"> Foto</label>
								<div class="col-md-4">
									<input type="hidden" name="option" class="form-control" id="option" value="<?php echo 0; ?>" />
									<input type="file" class="form-control-file" name="archivo"  id="archivo">
								</div>
							</div>
								<div class="box-footer">
									<a href="<?php echo base_url();?>CPersona/" class="btn btn btn-default btn-sm">
										<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
									</a>
									<button type="submit" class="btn btn-info btn-sm pull-right"> <span class="glyphicon glyphicon-ok-circle"></span> Guardar</button>
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
