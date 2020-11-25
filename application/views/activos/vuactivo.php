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
				<div class="col-md-10">
					<?php echo form_open_multipart(base_url() . 'activos/Cactivofijo/edit', array("class" => "form-horizontal")); ?>
					<div class="form-group">
						<input type="hidden" name="idActivofijo" id="idActivofijo" class="form-control"
							   value="<?php echo $update['idActivofijo']; ?>"
						/>
						<label for="idObtenido" class="col-md-4 control-label"><span class="text-danger">*</span>
							Obtenido por</label>
						<div class="col-md-4">
							<input type="hidden" id="idObtenido" name="idObtenido"
								   value="<?php echo $this->session->userdata('s_idPersona'); ?>">
							<select name="idObtenido" id="idObtenido" class="form-control">
								<?php
								foreach ($obtenido as $row) {
									echo '<option value="' . $row['idObtenido'] . '" >' . $row['obtenido'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="tipo" class="col-md-4 control-label"><span class="text-danger">*</span> Tipo</label>
						<div class="col-md-4">
							<input type="hidden" id="idPersona" name="idPersona"
								   value="<?php echo $this->session->userdata('s_idPersona'); ?>">
							<select name="idTipoActivoFijo" id="idTipoActivoFijo" class="form-control">
								<?php
								foreach ($tipoactivofijo as $row) {
									echo '<option value="' . $row['idTipoActivoFijo'] . '" >' . $row['tipo'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="codigo" class="col-md-4 control-label"><span class="text-danger">*</span>
							Código</label>
						<div class="col-md-3">
							<input type="text" class="form-control input-sm" name="codigo" id="codigo"
					 	   value="<?php echo ($this->input->post('codigo') ? $this->input->post('codigo') : $update['codigo']); ?>"
							readonly/>
							<span class="text-danger"><?php echo form_error('codigo'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="numeroSerie" class="col-md-4 control-label"><span class="text-danger">*</span>
							Número de serie</label>
						<div class="col-md-3">
							<input type="text" name="numeroSerie" id="numeroSerie" class="form-control"
								   value="<?php echo ($this->input->post('numeroSerie') ? $this->input->post('numeroSerie') : $update['numeroSerie']); ?>"
							/>
							<span class="text-danger"><?php echo form_error('numeroSerie'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span> Nombre
							Activo fijo</label>
						<div class="col-md-3">
							<input type="text" name="nombre" id="nombre" class="form-control"
								   value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $update['nombre']); ?>"
							/>
							<span class="text-danger"><?php echo form_error('nombre'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>
							Descripción Activo fijo</label>
						<div class="col-md-6">
							<input type="texta" name="descripcion" id="descripcion" class="form-control"
								   value="<?php echo ($this->input->post('descripcion') ? $this->input->post('descripcion') : $update['descripcion']); ?>"
							/>
							<span class="text-danger"><?php echo form_error('descripcion'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="estado" class="col-md-4 control-label"><span class="text-danger">*</span>
							Estado</label>
						<div class="col-md-4">
							<select name="idEstado" id="idEstado" class="form-control">
								<?php
								foreach ($estado as $row) {
									echo '<option value="' . $row['idEstado'] . '" >' . $row['estado'] .
										'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="valorInicial" class="col-md-4 control-label"><span class="text-danger">*</span>
							Valor inical</label>
						<div class="col-md-4">
							<input type="text" name="valorInicial" id="valorInicial" class="form-control"
								   value="<?php echo ($this->input->post('valorInicial') ? $this->input->post('valorInicial') : $update['valorInicial']); ?>"
							/>
							<span class="text-danger"><?php echo form_error('valorInicial'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="archivo" class="col-md-4 control-label">Imagen</label>
						<div class="col-md-6">
							<input type="hidden" name="option" class="form-control" id="option"
								   value="<?php echo 1; ?>"/>
							<input type="hidden" name="imagen" class="form-control" id="imagen"
								   value="<?php echo trim($update['imagen']); ?>"/>
							<input type="file" name="archivo" id="archivo" class="btn btn-default">
							<p class="help-block">
								Seleccionar Imagen.
								(Imagenes soportadas jpg, png, gif. Tamaño Maximo 1Mb).
							</p>
						</div>
					</div>

					<div class="box-footer">
						<a href="<?php echo base_url(); ?>activos/Cactivofijo/"
						   class="btn btn btn-default btn-md pull-right">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
						</a>
						<button type="submit" class="btn btn-info btn-md"><span
								class="glyphicon glyphicon-ok-circle"></span> Modificar
						</button>
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


