<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista del personal</div>
			<br>
			<div class="pull-left">
				<a href="<?php echo site_url('usuarios/CUsuario/insertUser'); ?>" class="btn btn-primary">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Usuario
				</a>
				<a href="<?php echo base_url();?>usuarios/CUsuario" target="_blank" class="btn btn-success">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista
				</a>
				<br/><br/>
			</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">No</th>
					<th width="10%">Nombre</th>
					<th width="15%">User</th>
					<th width="15%">Permiso</th>
					<th width="10%">Foto</th>
					<th width="10%">Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($usuario  as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['nombre']; ?></td>
						<td><?php echo $row['user']; ?></td>
						<td>
						<?php
						//echo $row['permiso'];
						$permisos = explode("#",$row['permiso']);

						$vacio =  count($permisos);
						if ($vacio==1)
						{
							$vacio=0;
						}
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
									echo "<span>
									<i class='fa fa-user-secret'></i> Perfil
									</span>";
									break;
								case $personalMd5:
									echo "<span>
									<i class='fa fa-male'></i> Personal
									</span>";
									break;
								case $activosFijosMd5:
									echo "<span>
									<i class='fa fa-desktop'></i> Activos Fijos
									</span>";
									break;
								case $movimientosMd5:
									echo "<span>
									<i class='fa fa-list'></i> Movimientos
									</span>";
									break;
								case $usuariosMd5:
									echo "<span>
									<i class='fa fa-users'></i> Usuarios
									</span>";
									break;
								case $reportesMd5:
									echo "<span>
									<i class='fa fa-print'></i> Reportes
									</span>";
									break;
								case $opcionesMd5:
									echo "<span>
									<i class='fa fa-gears'></i> Opciones
									</span>";
									break;
							}
						}
						?>
						</td>
						<td><img src="<?php echo base_url().'fotos/personas/'.$row['foto'];?>" width="60" height="80"></td>
						<td>
							<span class="pull-right">
								  <div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Acciones
									<span class="caret"></span>
									</button>
									 <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
										 <li>
											 <a href="<?php echo base_url().'usuarios/CUsuario/edit_User/'.$row['idUsuario']; ?>"
												title="Modificar informacion" onClick="">
												 <i style="color:#555;" class="glyphicon glyphicon-edit"></i> Modificar
											 </a>
										 </li>
                      					 <li>
											 <a href=""data-toggle="modal" data-target="#modalDelete"
												data-whatever="<?php echo $row['idUsuario']; ?>"
												title="Eliminar Activo Fijo">
											 <i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar
											 </a>
										 </li>
                      				     <li><a href="<?php echo base_url().'activos/Cactivofijo/Creport'.$row['idUsuario']; ?>"
												title="Imprimir formato">
												 <i class="glyphicon glyphicon-print" style="color:#006699"></i>
												 Imprimir
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
					<?php echo form_open(base_url().'usuarios/CUsuario/remove'); ?>
					<h4 align="center"></h4>
					<div class="form-group">
						<input type="hidden"  class="form-control" name="idUsuarioDelete" id="idUsuarioDelete">
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
	<script>
		var baseurl = "<?php echo base_url(); ?>";
	</script>


