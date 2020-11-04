<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<?php echo form_open_multipart(base_url().'CPersona/edit',array("class"=>"form-horizontal")); ?>
					<div class="form-group">
						<label for="ci" class="col-md-4 control-label">Ci <span class="text-danger">*</span></label>
						<div class="col-md-4">
							<input type="hidden"  class="form-control input-sm" name="idPersona" id="idPersona" value="<?php echo $idPersona; ?>"/>
							<input type="text"  class="form-control input-sm" name="ci" id="ci" value="<?php echo trim($ci); ?>" />
							<span class="text-danger"><?php echo form_error('ci');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombres</label>
						<div class="col-md-5">
							<input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo trim($nombres); ?>" />
							<span class="text-danger"><?php echo form_error('nombre');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="apellidoPaterno" class="col-md-4 control-label"><span class="text-danger">*</span>Apellido Paterno</label>
						<div class="col-md-6">
							<input type="text" name="apellidoPaterno" class="form-control" id="apellidoPaterno" value="<?php echo trim($apellidoPaterno); ?>"/>
							<span class="text-danger"><?php echo form_error('apellidoPaterno');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="apellidoMaterno" class="col-md-4 control-label"><span class="text-danger">*</span>Apellido Materno</label>
						<div class="col-md-6">
							<input type="text" name="apellidoMaterno" class="form-control" id="apellidoMaterno" value="<?php echo trim($apellidoMaterno); ?>"/>
							<span class="text-danger"><?php echo form_error('apellidoMaterno');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="cargo" class="col-md-4 control-label"><span class="text-danger">*</span>Cargo</label>
						<div class="col-md-4">
							<select name="cargo" class="form-control">
								<option value="1">Admistrativo</option>
								<?php
								$cargo_values = array(
									'1' => 'Admistrativo',
									'2' => 'Docente',
									'3' => 'Estudiante'
								);

								foreach($cargo_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('cargo')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('cargo');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="direccion" class="col-md-4 control-label"><span class="text-danger">*</span>Dirección</label>
						<div class="col-md-8">
							<input type="text" name="direccion" class="form-control" id="direccion" value="<?php echo trim($direccion); ?>" />
							<span class="text-danger"><?php echo form_error('direccion');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="telefono" class="col-md-4 control-label"><span class="text-danger">*</span>Telefono</label>
						<div class="col-md-4">
							<input type="text" name="telefono" class="form-control" id="telefono" value="<?php echo trim($telefono); ?>"  />
							<span class="text-danger"><?php echo form_error('telefono');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-md-4 control-label"><span class="text-danger">*</span>Email</label>
						<div class="col-md-5">
							<input type="text" name="email" class="form-control" id="email" value="<?php echo trim($email); ?>" />
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="archivo" class="col-md-4 control-label">Foto</label>
						<div class="col-md-5">
							<input type="hidden" name="option" class="form-control" id="option" value="<?php echo 1; ?>" />
							<input type="hidden" name="foto" class="form-control" id="foto" value="<?php echo trim($foto); ?>" />
							<input type="file" name="archivo"  id="archivo">
						</div>
					</div>
					<div class="box-footer">
						<a href="<?php echo base_url();?>CPersona/" class="btn btn btn-default btn-sm">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
						</a>
							<span class="glyphicon glyphicon-ok-circle"></span> Modificar
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
