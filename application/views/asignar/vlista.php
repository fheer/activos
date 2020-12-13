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
			if (!empty($mensaje)) {
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
				<div class="panel-title "><b>Lista Activos fijos Asignados</b></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="content-box-large">
				<div class="panel-body">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
						   id="example">
						<thead>
						<tr>
							<th width="5%" align="center">No</th>
							<th width="10%">Código</th>
							<th width="15%">Número de serie</th>
							<th width="15%">Nombre</th>
							<th width="15%">Fecha de compra</th>
							<th width="10%">Valor inicial</th>
							<th width="10%">Imagen</th>
							<th width="10%">Código QR</th>
							<th width="10%">Opciones</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;
						//foreach ($activofijo as $row)
						 { ?>
							<tr class="gradeA">
								<td align="center"><?php echo $i; ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
								</td>
							</tr>
							<?php $i++;
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--  Page content -->
</div>
</div>
</div>

