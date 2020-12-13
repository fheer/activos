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
if (empty($movimientos)){
	redirect(base_url()."Chome/");
}
?>
			<div class="col-md-10">
			<div class="row">
				<div class="col-md-12 panel-info">
					<?php
					if (!empty($mensaje))
					{
						?>
						<div class="alert alert-danger alert-dismissible" align="center">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fa fa-ban"></i>
							<?php echo $mensaje; ?>
						</div>
						<?php
					}
					?>
					<div class="panel-body">
						<div class="panel-title "><b>Asignar Activos fijos</b></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content-box-large">
						<?php echo form_open(  base_url().'asignar/CAsignar/add',array("class"=>"form-inline","target"=>"_blank")); ?>
						<div class="panel-body">
								<div class="form-group col-md-6 ">
									<label>Seleccione al Empleado</label>
									<br>
									<select id="idPersona" name="idPersona" class="form-control select2">
										<?php
										foreach ($persona as $row)
										{
										?>
											<option value="<?php echo $row['idPersona']; ?>">
													<?php echo $row['apellidoPaterno'].' '.$row['apellidoMaterno'].' '. $row['nombres']; ?>
											</option>
										<?php
										}
										?>
									</select>
								</div>
						</div>
						<div class="panel-body">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
								<tr>
									<th width="5%" align="center">No</th>
									<th width="20%">Código</th>
									<th width="35%">Nombre</th>
									<th width="10%">Imagen</th>
									<th width="10%">Código QR</th>
									<th width="10%">Asignar</th>
								</tr>
								</thead>
								<tbody>
								<?php $i = 1; foreach ($activofijo  as $row) { ?>
									<tr class="gradeA">
										<td align="center"><?php echo $i; ?></td>
										<td><?php echo $row['codigo']; ?></td>
										<td><?php echo $row['nombre']; ?></td>
										<td><img src="<?php echo base_url().'fotos/activos/'.$row['imagen'];?>"
												 width="60" height="80">
										</td>
										<td><img src="<?php echo base_url().'fotos/qr/'.$row['qr'];?>" width="60"
												 height="80">
										</td>
										<td style="vertical-align:middle;" align="center"><input type="checkbox" name="asignado[]"
										  value="<?php echo $row['idActivofijo'];?>" />
										</td>
									</tr>
									<?php $i++;	} ?>
								</tbody>
							</table>
							<div class="box-footer">
								<button type="submit" class="btn btn-success btn-md pull-left">
									<span class="glyphicon glyphicon-ok-circle"></span> Asignar</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<!--  Page content -->
		</div>
	</div>
</div>

