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
		<div class="panel-body">
			<div class="panel-title">Lista de Departamentos</div>
			<br>
			<div class="pull-left">
				<a href="<?php echo site_url('departamento/CDepartamento/insert_departamento'); ?>" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Departamento
				</a>
				<a href="<?php echo base_url();?>reportes/CReporteDepartamento/datos_departamento" target="_blank" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista
				</a>
				<br/><br/>
			</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="10%" align="center">No</th>
					<th width="40%">Departamento</th>
					<th width="10%">Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($departamento  as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['departamento']; ?></td>
						<td align="center">
							<span class="pull-center">
								  <div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Acciones
									<span class="caret"></span>
									</button>
									 <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
										 <li>
											 <a href="<?php echo base_url().'departamento/CDepartamento/update_departamento/'.$row['idDepartamento']; ?>"
												title="Modificar informacion" onClick="">
												 <i style="color:#555;" class="glyphicon glyphicon-edit"></i> Modificar
											 </a>
										 </li>
                      					 <li>
											 <a href=""data-toggle="modal" data-target="#modalDelete"
												data-whatever="<?php echo $row['idDepartamento']; ?>"
												title="Eliminar Activo Fijo">
											 <i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar
											 </a>
										 </li>
									 </ul>
								  </div>
							</span>
						</td>
					</tr>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Delete modal -->
	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalDeleteLabel">Eliminar</h4>
				</div>
				<div class="modal-body">
					<?php echo form_open(base_url().'departamento/CDepartamento/remove'); ?>
					<h4 align="center"></h4>
					<div class="form-group">
						<input type="hidden"  class="form-control" name="idDepartamentoDelete" id="idDepartamentoDelete">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnEliminar" class="btn btn-primary">Eliminar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var baseurl = "<?php echo base_url(); ?>";
	</script>


