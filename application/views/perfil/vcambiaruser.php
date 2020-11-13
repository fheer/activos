		<div class="col-md-10">
			<div class="content-box-large">
				<?php
				if (!empty($mensaje))
				{
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
					<section class="content">
						<div class="row">
							<div class="col-md-8">
								<div class="box box-success">
									<div class="box-header">
										<h3 class="box-title">Cambiar datos de Acceso</h3>
									</div>
									<?php
										foreach ($usuario as $row) {
											$userName = $row['user'];
										}
									?>
									<div class="box-body col-md-10">
										<?php echo form_open(base_url().'perfil/CPerfil/edit/'.$row['idUsuario'],
															array("class"=>"form-inline")); ?>
										<div class="form-group col-md-6">
											<label for="user" class="col-md-9 control-label">Nombre de usuario</label>
											<input type="text" class="form-control" id="user" name="user"
											 value="<?php echo $userName; ?>" />
											<span class="text-danger"><?php echo form_error('user');?></span>
										</div>
										<div class="form-group col-md-6">
											<label for="clave" class="col-md-10 control-label">Nueva Contraseña</label>
											<input type="text" class="form-control" id="clave" name="clave" />
											<span class="text-danger"><?php echo form_error('clave');?></span>
										</div>
									</div>
									<div class="">
										<button type="submit" class="btn btn-success btn-md ">
											<span class="glyphicon glyphicon-ok-circle"></span> Guardar Cambios
										</button>
										<a href="<?php echo base_url();?>usuarios/CUsuario" class="btn btn btn-default btn-md pull-right">
											<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
										</a>
									</div>
									<?php echo form_close(); ?>
									<br>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>

