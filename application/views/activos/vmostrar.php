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
		<div class="panel-body">
			<div class="pull-left">
				<h1>Activo Fijo</h1>
			</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">
				<thead>
				<tr>
					<th width="10%">Código</th>
					<th width="15%"><?php echo $activofijo['codigo']; ?></th>
				</tr>
				<tr>
					<th width="15%">Número de serie</th>
					<th width="15%"><?php echo $activofijo['numeroSerie']; ?></th>
				</tr>
				<tr>
					<th width="15%">Nombre</th>
					<th width="15%"><?php echo $activofijo['nombre']; ?></th>
				</tr>
				<tr>
					<th width="15%">Descripcion</th>
					<th width="10%"><?php echo $activofijo['descripcion']; ?></th>
				</tr>
				<tr>
					<th width="10%">Fecha Ingreso</th>
					<th width="10%"><?php setlocale(LC_TIME, 'es_ES.UTF-8');
						// En windows
						setlocale(LC_TIME, 'spanish');
						echo $activofijo['fechaCompra']; ?></th>
				</tr>

				<tr>
					<th width="10%">Valor inicial</th>
					<th width="10%"><?php echo $activofijo['valorInicial']; ?> Bs.</th>
				</tr>
				<tr >
					<th width="10%" colspan="2" style="text-align: center"><img src="<?php echo base_url().'fotos/activos/'.$activofijo['imagen'];?>" width="100" height="180"></th>
				</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
