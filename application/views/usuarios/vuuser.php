
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
			<section class="content">
				<div class="row">
					<div class="box-header">
							<h3 class="box-title">Modificar Permisos Usuario</h3>
						<div class="box-body col-md-10">
							<?php echo form_open(base_url().'usuarios/CUsuario/edit',array("class"=>"form-inline")); ?>
							<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario['idUsuario']; ?>">
							<div class="form-group col-md-4">
								<label hidden for="clave" class="col-md-6 control-label">email</label>
								<input type="hidden" class="form-control" id="email" name="email" >
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- Form Element sizes -->
				</div>
				<div class="row">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Acceso a:</h3>
						</div>
						<?php
						//echo $row['permiso'];
						$permisos = explode("#",$usuario['permiso']);

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
						?>
						<div class="box-body col-md-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>
										<input type="checkbox" id="perfil" name="perfil" class="flat-green"
											   readonly="readonly" checked onclick="javascript: return false;">
										Perfil
									</label>
								</div>
								<div class="form-group">
									<label>
										<?php
										if (!empty($personal))
										{
										?>
										<input type="checkbox" id="personal" name="personal" class="flat-green" checked>
										Personal
										<?php
										}else{
										?>
										<input type="checkbox" id="personal" name="personal" class="flat-green">
										Personal
										<?php
										}
										?>
									</label>
								</div>
								<div class="form-group">
									<label>
										<?php
										if (!empty($activos))
										{
										?>
										<input type="checkbox" id="activos" name="activos" class="flat-green" checked>
										Activos
										<?php
										}else{
											?>
											<input type="checkbox" id="activos" name="activos" class="flat-green">
											Activos
											<?php
										}
										?>
									</label>
								</div>
								<div class="form-group">
									<label>
										<?php
										if (!empty($movimientos))
										{
										?>
										<input type="checkbox" id="movimientos" name="movimientos" class="flat-green" checked>
										Movimientos
										<?php
										}else{
										?>
											<input type="checkbox" id="movimientos" name="movimientos" class="flat-green">
											Movimientos
										<?php
										}
										?>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>
										<?php
										if (!empty($usuarios))
										{
										?>
										<input type="checkbox" id="usuarios" name="usuarios" class="flat-green" checked>
										Usuarios
										<?php
										}else{
											?>
											<input type="checkbox" id="usuarios" name="usuarios" class="flat-green">
											Usuarios
										<?php
										}
										?>
									</label>
								</div>
								<div class="form-group">
									<label>
										<?php
										if (!empty($reportes))
										{
										?>
										<input type="checkbox" id="reportes" name="reportes" class="flat-green" checked>
										Reportes
										<?php
										}else{
										?>
										<input type="checkbox" id="reportes" name="reportes" class="flat-green">
										Reportes
										<?php
										}
										?>
									</label>
								</div>
								<div class="form-group">
									<label>
										<?php
										if (!empty($opciones))
										{
										?>
										<input type="checkbox" id="opciones" name="opciones" class="flat-green" checked>
										Opciones
										<?php
										}else{
										?>
											<input type="checkbox" id="opciones" name="opciones" class="flat-green">
											Opciones
										<?php
										}
										?>
									</label>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>

				<div class="">
					<button type="submit" class="btn btn-info btn-md ">
						<span class="glyphicon glyphicon-ok-circle"></span> Modificar Usuario
					</button>
					<a href="<?php echo base_url();?>usuarios/CUsuario" class="btn btn btn-default btn-md pull-right">
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

