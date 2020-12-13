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
	<div class="callout callout-default">
		<h4>Depreciación</h4>
		<h4>Activo Fijo: <?php echo $activofijo['nombre'];?></h4>
		<h4>Código: <?php echo $activofijo['codigo'];?></h4>
		<h4>Valor Inicial: <?php echo $activofijo['valorInicial'];?></h4>
		<h4>Vida Util: <?php echo $vidautil['vidautil'];?></h4>
	</div>
	<div class="content-box-large">
		<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">Año</th>
					<th width="15%">Valor Depreciacion</th>
					<th width="15%">Valor Acumulada Depreciacion</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($depreciacion  as $row) { ?>
				<tr class="gradeA">
					<td align="center"><?php echo 'Año '.$i; ?></td>
					<td><?php echo $row['valorDepreciacion']; ?></td>
					<td><?php echo $row['valorAcumuladoDepreciacion']; ?></td>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
